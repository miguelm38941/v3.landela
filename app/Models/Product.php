<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_code', 'product_label', 'rafael_product_code', 'rafael_product_label', 'supplier_code', 'refinery_code', 'refinery_label'
    ];
}
