<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StandardBL extends Model
{
    protected $fillable = [
        'delivery_note', 'purchase_order', 'supplier_code', 'supplier_label', 'refinery_code', 'refinery_label', 'installation_code', 'installation_label', 'customer_code', 'customer_label',
        'product_code', 'product_label', 'loadin_date', 'transporter_code', 'transporter_label', 'transport_include', 'quantity', 'buying_price', 'transport_rate', 'selling_price', 'code_customer_to_invoce'
    ];
}
