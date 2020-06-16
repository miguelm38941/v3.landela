<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ville extends Model
{

    /**
     * Get the comments for the blog post.
     */
    public function users()
    {
        return $this->hasMany('App\User');
    }

}
