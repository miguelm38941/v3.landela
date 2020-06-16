<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Providers\WorkstationServiceProvider as Workstation;
use App\User;

class homeController extends Controller
{
    /**
     * Display a home page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('home.launch');
    }

    private function saveWorkstationInfo($winUser)
    {//not used!!!!!!!!!!!!!!!!!!!!!!!
        $user = \App\User::firstWhere('username', $winUser['cp_username']);
        if( !empty($user) && ($user->computername=='') && ($user->cp_uniq_id=='')):
            $user->computername = $winUser['cp_name'];
            $user->cp_uniq_id = $winUser['cp_uniq_id'];
            return ($user->save()) ? true : false;
        endif;
        return false;
    }

    private function checkWinUserExist($winUser)
    {
        $user = false;
        $user = \App\User::where('username', $winUser['cp_username'])->first();
        return $user;
    }

    private function matchWorkstation($workstationUser, $workstation)
    {
        //if( ($workstationUser->computername==$workstation['computer_name'])
        //        && ($workstationUser->volume_label==$workstation['volume_label']) ){
        /*if( ($workstationUser->computername==$workstation['computer_name']) ){
            return true;
        }*/
        return true;
    }

    private function check_cookie_exist(Request $request)
    {
        $acc['new_pc'] = false;
        $acc['can_login'] = false;
        $acc['new_user'] = false;
        $thecookie = $request->cookie('COL_BITUMES_AUTH');
        if($thecookie!=null){
            $acc['can_login'] = true;
        }
        else{
            $acc['new_user'] = true;
        }
        return $acc;
    }

    private function check_user_access($workstationUser, $workstation)
    {
        $acc['new_pc'] = false;
        $acc['can_login'] = false;
        $acc['new_user'] = false;

        $win_username = $workstation['window_user'];
        $cp_name = $workstation['computer_name'];
        $svr_name = $workstation['volume_label'];

        if(isset($workstationUser->username)
                && ($workstationUser->username==$win_username)
                && (!$this->matchWorkstation($workstationUser, $workstation)) ){
            $acc['new_pc'] = true;
        }
        if( isset($workstationUser->username)
                && ($workstationUser->username==$win_username)
                && ($this->matchWorkstation($workstationUser, $workstation)) ){
            $acc['can_login'] = true;
        }
        //if( ($workstationUser->username!=$win_username) ){
        if( !isset($workstationUser->username) ){
            $acc['new_user'] = true;
        }
        return $acc;
    }

    private function setCookies()
    {
        return true;
    }
}
