<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrganisationType extends Model
{
    /**
     * Get the comments for the blog post.
     */
    public function organisations()
    {
        return $this->hasMany('App\Models\Organisation');
    }
}
