<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VitolBL extends Model
{
    protected $fillable = [
        'client', 'incoterm', 'product', 'period', 'order_number', 'bl_date', 'status', 'net_quantity', 'uom_quantity', 'ship_to', 'country', 'transporter'
    ];
}
