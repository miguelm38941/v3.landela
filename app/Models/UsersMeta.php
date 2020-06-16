<?php
/*
 * Ce model enregistre les données des PVV sauf les données
 * déjà présentes dans le model User
 * 
 */
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class UsersMeta extends Model implements Searchable
{
    public function pvv()
    {
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function getSearchResult(): SearchResult
    {
        $url = route('pvv.list', $this->id);
 
        return new SearchResult(
            $this,
            $this->user_id,
            $url
        );
    }
}
