<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ZoneSante extends Model
{
    public function pvv()
    {
        return $this->hasOne('App\User', 'zone_sante_id', 'id');
    }
}
