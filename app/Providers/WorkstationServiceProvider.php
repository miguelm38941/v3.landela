<?php

namespace App\Providers;

class WorkstationServiceProvider
{
    public function retrieve()
    {
        $win_username = (getenv('username'))?getenv('username'):null;
        $cp_name = (getenv('computername'))?getenv('computername'):null;
        $svr_name = (getenv('logonserver'))?getenv('logonserver'):null;
        //$cp_uniq_id = openssl_random_pseudo_bytes(512);
        $volume_label = "H234-FG56"; //str_replace("(","",str_replace(")","",$this->GetVolumeLabel("c")));

        return array('window_user'=>$win_username, 'computer_name'=>$cp_name, 'volume_label'=>$volume_label);
    }

    function getVolumeLabel($drive) {
        // Try to grab the volume name
        if (preg_match('#Volume Serial Number is (.*)\n#i', shell_exec('dir '.$drive.':'), $m)) {
            $volname = ' ('.$m[1].')';
        } else {
            $volname = '';
        } return str_replace(' ', '', $volname);
    }
}
