<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Helpers\General\CollectionHelper;
use Spatie\Searchable\Search;
use \App\User;

class PvvController extends UsersController
{

    public function displayPvvList($tag=false)
    {
        if(!$tag){ // Display all
            $users = \App\User::whereHas(
                                            'roles', function($q){
                                                $q->where('slug', 'ROLE_PVV');
                                            }
                                        )->get();
            $total = $users->count();
            $pageSize = 20;
            $users = CollectionHelper::paginate($users, $total, $pageSize);
        }
        else{
            $users = \App\User::whereHas(
                                            'roles', function($q){
                                                $q->where('slug', 'ROLE_PVV');
                                            }
                                        )->get();
        }
        //$user = \App\User::find(11);
        //dd($user->pvv_data->codepvv);
        return view('pvv.index', ['users' => $users]);
    }

    

    public function searchPvv(String $searchParam)
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
                <td>'.$user->pvv_data->codepvv.'</td>
                <td>'.$user->zone_sante->nom.'</td>
                <td>'.$user->region_sante->nom.'</td>
                <td>
                </td>
                <td><span class="glyphicon glyphicon-remove"></span>
                    <a href="'. route('users.edit',$user->id).'" class="btn btn-sm btn-primary">Modifier</a>
                </td>
            </tr>';
        endforeach;
        return $html;

    }

}
