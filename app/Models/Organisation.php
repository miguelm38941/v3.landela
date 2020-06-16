<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Organisation extends Model
{
    protected $fillable = [
        'nom', 'type_id'
    ];

    /**
     * Get the comments for the blog post.
     */
    public function users()
    {
        return $this->hasMany('App\User', 'organisation_id', 'id');
    }

}
