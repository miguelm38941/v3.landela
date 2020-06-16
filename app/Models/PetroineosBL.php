<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PetroineosBL extends Model
{
    protected $fillable = [
        'ot', 'dspc_number', 'pickup_on', 'customs_date', 'product', 'order_ref', 'net_weight', 'ot_sap', 'buyer', 'declaring', 'billed', 'sap_date', 'cpdp_date', 'recipient'
    ];
}