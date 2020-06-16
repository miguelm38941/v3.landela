<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use Gate;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
Use Redirect;
use App\Providers\PermissionServiceProvider as Permission;
use \App\Models\ZoneSante; 
use \App\Models\RegionSante;
use \App\Models\Ville; 
use \App\Role;
use \App\Models\User_temp;


class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('self_register_form','self_register');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'first_name' => ['required', 'string', 'min:3'],
            'last_name' => ['required', 'string', 'min:3'],
            'username' => ['required', 'string', 'min:6'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
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
    }


    public function register(Request $request)
    {   

        /*$user = new \App\User();
        $user->first_name = $request['username'],
        $user->last_name = $request['username'];
        $user->username = $request['username'];
        $user->birthdate = $request['username'];
        $user->etat_civil = $request['username'];
        $user->sexe = $request['username'];
        $user->username = $request['username'];
        $user->username = $request['username'];
        $user->username = $request['username'];
        $user->username = $request['username'];
        $user->username = $request['username'];
        $user->username = $request['username'];
        $user->username = $request['username'];
        $user->username = $request['username'];
        $user->username = $request['username'];
        $user->username = $request['username'];
        $user->username = $request['username'];
        $user->username = $request['username'];
        dd($user);*/
        /*if(Gate::denies('register-user'))
        {
            return redirect(route('delivery-process'));
        }*/
        $villes = Ville::All();
        $zones = ZoneSante::All();
        $regions = RegionSante::All();
        $provinces = Ville::All();
      
        if($request['username']!=null) {
            $user = new User(); 
            $user->saveUser($this->prepareDataArray($request));
            //$this->create($this->prepareDataArray($request));
            //$user->roles()->sync($request['roles']);
            return Redirect::back();
            //return redirect()->back()->withErrors($validator)->withInput();
        }

        $roles = Role::All();
        return view('auth.register', compact('roles', 'zones', 'regions', 'villes', 'provinces'));
        //$user = $this->create($request);
        //$user->roles()->attach($adminRole);
    }

    public function self_register_form(Request $request)
    {
        //$user = $this->registerUserRequest($requestFields);
        return view('auth.req_register', ['requesttype'=>$request['requesttype']]);
    }

    public function self_register(Request $request)
    {
        $user = new User_temp();
        $user->first_name = $request['prenom'];
        $user->last_name = $request['nom'];
        $user->email = $request['email'];
        $user->username = $request['username'];
        //$user->computername = getenv('computername');
        $user->volume_label = str_replace("(","",str_replace(")","",$this->GetVolumeLabel("c")));
        $user->requesttype = $request['requesttype'];
        if($user->save()){
            session()->flash('success', 'Votre demande a été envoyée.');
        }
        else{
            session()->flash('error', 'Votre demande n\'a pu être effectuée. Réessayez plus tard s\'il vous plaît!');
        }
        return redirect('/');
    }

    public function approve_register(Request $request)
    {
        $data = $this->prepareDataArray($request);

        if($request->requesttype=='requestNewRegistration'){
            if($user = $this->create($data)){
                $userRole = Role::where('slug', 'ROLE_USER')->first();
                $user->roles()->attach($userRole);
                $this->removeTempUserRequest($request['id'], false);
                session()->flash('success', sprintf('Le compte utilisateur %s a été autorisé avec succès.', $user->username));
            }
            else{
                session()->flash('error', 'Une erreur est survenue. Veuillez réessayer plus tard.');
            }
        }
        elseif($request->requesttype=='AddNewWorkstation'){
            $existingUser = User::where('username', $requestFields['username'])->first();
            $existingUser->comptername = $user->comptername;
            $existingUser->volume_label = $user->volume_label;
            $existingUser->active = false;
            if($user = $existingUser->save()){
                $roleUser = Role::where('slug', 'ROLE_USER')->first();
                $user->roles()->attach($roleUser);
                $this->removeTempUserRequest($request['id'], false);
                session()->flash('success', sprintf('Le compte utilisateur %s a été autorisé avec succès.', $user->username));
            }
            else{
                session()->flash('error', 'Une erreur est survenue. Veuillez réessayer plus tard.');
            }
        }
        else{
            session()->flash('error', 'Type de requête inconnue pour ce compte. Veuillez réessayer plus tard');
        }
        //return redirect('/registrations/registration_requests');
        return Redirect::back();
    }

    private function prepareDataArray(Request $request)
    {
        $data = array();
        $data['first_name'] = $request['first_name'];
        $data['last_name'] = $request['last_name'];
        $data['email'] = $request['email'];
        $data['username'] = $request['username'];
        $data['password'] = $request['password'];
        //$data['computername'] = $request['computername'];
        $data['birthdate'] = $request['date_naissance'];
        $data['etat_civil'] = $request['etat_civil'];
        $data['ville_id'] = $request['ville'];
        $data['organisation_id'] = 1;
        $data['zone_sante_id'] = $request['zonesante'];
        $data['region_sante_id'] = $request['regionsante'];
        $data['telephone'] = $request['phone'];
        $data['sexe'] = $request['sexe'];
        $data['active'] = true;
        $data['requesttype'] = $request['requesttype'];
        $data['roles'] = $request['roles'];
        return $data;
    }

    public function resetAccess(int $id)
    {
        $user = User::where('id', $id)->first();
        $user->cp_uniq_id = null;
        $user->verified_at = null;
        if($user->save()){
            session()->flash('success', sprintf('Le compte utilisateur %s a été réinitialisé avec succès.', $user->username));
        }
        else{
            session()->flash('error', 'Echec de la réinitialisation.');
        }
        return Redirect::back();
    }


}
