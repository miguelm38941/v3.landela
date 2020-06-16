<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Consultation extends Model
{
    /**
     * Get the user that owns the consultation.
     */
    public function pvv()
    {
        return $this->belongsTo('App\User', 'pvv_id', 'id');
    }
    public function agent()
    {
        return $this->belongsTo('App\User', 'agent_id', 'id');
    }
    public function medecin()
    {
        return $this->belongsTo('App\User', 'medecin_id', 'id');
    }
    public function infirmier()
    {
        return $this->belongsTo('App\User', 'infirmier_id', 'id');
    }

    public function diagnostic()
    {
        return $this->hasOne('App\Diagnostic', 'consultation_id', 'id');
    }
}
