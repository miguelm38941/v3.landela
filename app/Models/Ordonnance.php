<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ordonnance extends Model
{
    public function ordonnanceProduits()
    {
        return $this->hasMany('App\OrdonnanceProduit', 'ordonnance_id', 'id');
    }
}
