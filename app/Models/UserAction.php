<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAction extends Model
{
    protected $fillable = [
        'username', 'action', 'start_date', 'end_date', 'template', 'nbr_imported_lines', 'enabled'
    ];
}
