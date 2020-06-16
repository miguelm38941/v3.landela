<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    public function ligne_produits()
    {
        return $this->hasMany('App\LigneProduit');
    }
    
}
