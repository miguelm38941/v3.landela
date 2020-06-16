<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ert extends Model
{
    protected $fillable = [
        'alternate_code', 'identifier', 'label', 'customer_number', 'address1', 'address2', 'zip_code', 'city', 'country', 'payment_mode', 'vat_number'
    ];
}
