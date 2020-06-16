<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RegionSante extends Model
{
    public function pvv()
    {
        return $this->hasOne('App\User', 'region_sante_id', 'id');
    }
}
