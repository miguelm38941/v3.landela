<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;  // Import Hash facade
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;
use DB;

class User extends Authenticatable implements Searchable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 
        'last_name', 
        'username', 
        'email', 
        'password', 
        'computername', 
        'volume_label', 
        'cp_uniq_id', 
        'verified_at', 
        'birthdate',
        'etat_civil',
        'ville_id',
        'organisation_id',
        'zone_sante_id',
        'region_sante_id',
        'telephone',
        'sexe',
        'active'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'verified_at' => 'datetime',
    ];

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    public function roles()
    {
        return $this->belongsToMany('App\Role');
    }

    public function hasAnyRole($roles)
    {
        if(is_array($roles)){
            if($this->roles()->whereIn('slug', $roles)->first())
            {
                return true;
            }
        }else{
            if($this->roles()->where('slug', $roles)->first())
            {
                return true;
            }
        }
        return false;
    }

    public function isAdmin()
    {
        foreach ($this->roles()->get() as $role)
        {
            if ($role->slug == 'ROLE_ADMIN'){ return true; }
        }
        return false;
    }
    
    public function isPvv()
    {
        foreach ($this->roles()->get() as $role)
        {
            if ($role->slug == 'ROLE_PVV'){ return true; }
        }
        return false;
    }
    
    public function isEducateur()
    {
        foreach ($this->roles()->get() as $role)
        {
            if ($role->slug == 'ROLE_EDUCATEUR'){ return true; }
        }
        return false;
    }
    
    public function isAgent()
    {
        foreach ($this->roles()->get() as $role)
        {
            if ($role->slug == 'ROLE_AGENT'){ return true; }
        }
        return false;
    }
    
    public function isInfirmier()
    {
        foreach ($this->roles()->get() as $role)
        {
            if ($role->slug == 'ROLE_INFIRMIER'){ return true; }
        }
        return false;
    }
    
    public function isMedecin()
    {
        foreach ($this->roles()->get() as $role)
        {
            if ($role->slug == 'ROLE_MEDECIN'){ return true; }
        }
        return false;
    }
    
    public function isPrepose()
    {
        foreach ($this->roles()->get() as $role)
        {
            if ($role->slug == 'ROLE_PREPOSE'){ return true; }
        }
        return false;
    }
    
    public function isLaborantin()
    {
        foreach ($this->roles()->get() as $role)
        {
            if ($role->slug == 'ROLE_LABORANTIN'){ return true; }
        }
        return false;
    }
    
    public function isUser()
    {
        foreach ($this->roles()->get() as $role)
        {
            if ($role->slug == 'ROLE_USER'){ return true; }
        }
        return false;
    }

    /**
     * Get the organisations for the blog post.
     */
    public function organisations()
    {
        return $this->hasMany('App\Models\Organisation');
    }

    /**
     * Get the consultations for the user.
     */
    public function consultations_pvv()
    {
        return $this->hasMany('App\Models\Consultation', 'pvv_id', 'id');
    }
    public function consultations_agent()
    {
        return $this->hasMany('App\Models\Consultation', 'agent_id', 'id');
    }
    public function consultations_medecin()
    {
        return $this->hasMany('App\Models\Consultation', 'medecin_id', 'id');
    }
    public function consultations_infirmier()
    {
        return $this->hasMany('App\Models\Consultation', 'infirmier_id', 'id');
    }
    
    public function pvv_data()
    {
        return $this->hasOne('App\Models\UsersMeta', 'user_id', 'id');
    }    
    
    /**
    * Get the organisation that owns the user.
    */
    public function organisation()
    {
       return $this->belongsTo('App\Models\Organisation', 'organisation_id', 'id');
    }
    
    public function zone_sante()
    {
       return $this->belongsTo('App\Models\ZoneSante', 'zone_sante_id', 'id');
    }
    
    public function region_sante()
    {
       return $this->belongsTo('App\Models\RegionSante', 'region_sante_id', 'id');
    }

    public function selectUsersByOrganisation($orgId)
    {
        $users = User::select('id','first_name','last_name')
                                        ->where('organisation_id', $orgId)
                                        ->get();
        return $users;
    }

    public function getSearchResult(): SearchResult
    {
        $url = route('pvv.list', $this->id);
 
        return new SearchResult(
            $this,
            $this->first_name,
            $url
        );
    }

    public function saveUser(array $data){
        try {
            DB::transaction(function() use ($data) {

                $user = $this->create([
                    'first_name' => $data['first_name'],
                    'last_name' => $data['last_name'],
                    'email' => $data['email'],
                    'username' => $data['username'],
                    'password' => $data['password'],
                    //'computername' => $data['computername'],
                    'birthdate' => '1999-10-18',//$data['birthdate'],
                    'etat_civil' => $data['etat_civil'],
                    'ville_id' => $data['ville_id'],
                    'organisation_id' => 1,
                    'zone_sante_id' => $data['zone_sante_id'],
                    'region_sante_id' => $data['region_sante_id'],
                    'telephone' => $data['telephone'],
                    'sexe' => $data['sexe'],
                    'active' => 1,
                    'requesttype' => $data['requesttype'],
                ]);

                $user->roles()->sync($data['roles']);

                $um = new usersMeta();
                $um->user_id = $user->id;
                $um->codepvv = $this->generate_pvvcode();
                $um->adresse = $user->id;
                $um->debut_depistage = '1999-10-18';
                $um->debut_traitement = '1999-10-18';
                $um->save();

            }, 3);  // Retry 3 more times before failing miserably
        } catch (ExternalServiceException $exception) {
            return 'Sorry, the External Service is down and you cannot complete the registration without the keys from it';
        }
    }
    
	private function generate_pvvcode(){
		$c1="CDVS";
		$c2=rand(1,99999);
		$c2=str_pad($c2, 5, '0', STR_PAD_LEFT);
		$c3=range('a','z');
		shuffle($c3);
		$c3=strtoupper($c3[0]);
		$c = $c1.$c2.$c3;
		return $c;
	}
}