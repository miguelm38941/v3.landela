<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Diagnostic extends Model
{
    protected $table = 'diagnostics';
    /**
     * Get the consultation that owns this object.
     */
    public function consultation()
    {
        return $this->belongsTo('App\Consultation', 'consultation_id', 'id');
    }
}
