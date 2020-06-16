<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShellBL extends Model
{
    protected $fillable = [
        'delivery', 'shipment', 'purchase_order_number', 'sale_order', 'sold_to_pt', 'name_of_sold_to_party',
        'ship_to', 'name_of_the_ship_to_party', 'location_of_the_ship_to_party', 'material', 'description', 'total_weight',
        'wun', 'plnt', 'plant', 'loadg_date', 'delivery_date', 'bill_doc', 'price_ht'
    ];
}
