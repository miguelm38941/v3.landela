<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vat extends Model
{
    protected $fillable = [
        'refinery_code', 'refinery_label', 'supplier_code', 'vat_code', 'vat_value', 'rafael_vat_code'
    ];
}
