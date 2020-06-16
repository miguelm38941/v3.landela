<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ZoneSantes extends Controller
{

    /**
     * Get the comments for the blog post.
     */
    public function users()
    {
        return $this->hasMany('App\User');
    }

}
