<?php
namespace App\Http\Controllers;

use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
Use Redirect;
Use \Illuminate\Http\Request;
use Spatie\Searchable\Search;
use \App\User;

class UsersController extends Controller 
{
    public function import() 
    {
        Excel::import(new UsersImport, 'users.xlsx');
        //Excel::import(new UsersImport, request()->file('your_file'));
        
        return redirect('/')->with('success', 'All good!');
    }

    public function displayUsers($tag=false)
    {
        if(!$tag){
            $users = \App\User::paginate(20);
        }
        else{
            $users = \App\User::whereHas(
                                            'roles', function($q){
                                                $q->where('slug', 'PVV_ROLE');
                                            }
                                        )->get();
        }

        return view('users.index', ['users' => $users]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editUser($id)
    {
        $user = \App\User::find($id);
        $roles = \App\Role::All();
        return view('users.edit', compact('user','roles')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'username'=>'required',
        ]);
        $user = \App\User::find($id);
        $user->username =  $request->get('username');
        $user->first_name = $request->get('first_name');
        $user->last_name = $request->get('last_name');
        $user->computername = $request->get('computername');
        $user->volume_label = $request->get('volume_label');
        $user->save();
        $user->roles()->attach($request->get('roles'));
        return redirect()->route('users.list')->with('success', sprintf('Le compte %s a bien été mis à jour!', $user->username));
    }
    public function toggleActive(int $id, $value)
    {
        $user = \App\User::where('id', $id)->first();
        $user->active = ($value==1)? true:false;
        if($user->save()){
            session()->flash('success', 'L\'opération a été faite avec succès.');
        }
        else{
            session()->flash('error', 'Echec de la l\'opération.');
        }
        return Redirect::back();
    }

    public function destroyUser(int $id)
    {
        $user = \App\User::where('id', $id);
        $user->roles()->detach();
        if(\App\User::destroy($id)){
            session()->flash('success', 'Le compte a été supprimé avec succès.');
        }
        else{
            session()->flash('error', 'Ce compte ne peut être supprimé.');
        }
        return Redirect::back();
    }

    public function searchUsers(String $searchParam)
    {
        $searchterm = $searchParam;//$request->input('query');
 
        $searchResults = (new Search())
                    //->registerModel(\App\User::class, 'first_name', 'last_name')
                    ->registerModel(\App\Models\UsersMeta::class, 'codepvv')
                    ->perform($searchterm);
        // If results found, check users_meta 

        //dd($searchResults[0]->searchable);
        $titles = [];
        foreach ($searchResults as $result) {
            $user_id = $result->title;
            array_push($titles, $user_id);
        }
        $users = User::whereIn('id', $titles)->paginate(10);
    
        $html = '';
        foreach ($users as $user):
            $html .= '
            <tr>
                <td>'.$user->first_name.' '.$user->last_name.'</td>
                <td>'.$user->email.'</td>
                <td>'.$user->username.'</td>
                <td>'.$user->computername.'</td>
                <td>'.$user->volume_label.'</td>
                <td>';
                if (count($user->roles()->get()) > 0):
                    foreach($user->roles()->get() as $role):
                        $html .= $role->name;
                    endforeach;
                endif;
                $html .= '</td>
                <td>
                </td>
                <td><span class="glyphicon glyphicon-remove"></span>
                    <a href="'. route('users.edit',$user->id).'" class="btn btn-sm btn-primary">Modifier</a>';
                    if($user->active==0){
                        $html .= '<a data-method="PUT" data-confirm="Souhaitez-vous activer ce compte ?" href="'. route('user.toggle.access',[$user->id,1]).'" class="btn btn-sm btn-light">Activer</a>';
                    }else{
                        $html .= '<a data-method="PUT" data-confirm="Souhaitez-vous suspendre ce compte ?" href="'. route('user.toggle.access',[$user->id,0]).'" class="btn btn-sm btn-primary">Suspendre</a>';
                    }
                    if($user->verified_at==null){
                        $html .= '<a class="btn btn-sm btn-light disabled">Réinitialiser</a>';
                    }else{
                        $html .= '<a data-method="PUT" data-confirm="Souhaitez-vous réinitialiser ce compte ?" href="'. route('user.reset',$user->id).'" class="btn btn-sm btn-primary">Réinitialiser</a>';
                    }
                    $html .= '<a data-method="DELETE" data-confirm="Souhaitez-vous supprimer ce compte ?" href="'. route('user.destroy',$user->id).'" class="btn btn-sm btn-danger">Supprimer</a>
                </td>
            </tr>';
        endforeach;
        return $html;

        //return view('users.index', compact('searchResults', 'searchterm'));
    }
}