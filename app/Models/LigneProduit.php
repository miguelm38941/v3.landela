<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LigneProduit extends Model
{
    public function produits()
    {
        return $this->belongsToMany('App\Produit');
    }
}
