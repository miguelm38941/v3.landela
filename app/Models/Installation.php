<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Installation extends Model implements Searchable
{
    protected $fillable = ['ue', 'ue_mnemo', 'ue_lib_installation', 'dossier_zephyr', 'up', 'up_mnemo'];

    public function getSearchResult(): SearchResult
    {
        $url = route('installations.show', $this->id);

        return new SearchResult(
            $this,
            $this->ue,
            $url
         );
    }
}
