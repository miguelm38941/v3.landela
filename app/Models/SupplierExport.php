<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupplierExport extends Model
{
    protected $fillable = [
        'loading_date', 'delivry_note', 'product_code', 'code_bitume', 'activity_bitumpo', 'installation_allocation_imputation',
        'supplier_code', 'code_02_vat', 'code_u', 'quantity', 'amount_0', 'buying_price', 'code_s', 'product_label', 'code_vat_y', 'code_60121'
    ];
}
