<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BlayeBL extends Model
{
    protected $fillable = [
        'bl_day', 'command_number', 'accounting_site_code', 'bl_product_code', 'bl_site_code', 'customer_delivery_label', 'quantity',
    ];
}
