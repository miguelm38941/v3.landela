<?php

namespace App\Exports;

use App\Models\StandardBL;
use App\Models\SupplierExport;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class SuppliersExport implements FromView
{
    public function view(): View
    {
        return view('exports.suppliers', ['exportData' => self::getExportData()]);
    }

    function getExportData() {
        $data = StandardBL::all();
        $exportData = [];
        foreach ($data as $item) {
            $row = new SupplierExport([
                'loading_date' => $item->loadin_date,
                'delivry_note' => $item->delivery_note,
                'product_code' => $item->product_code,
                'code_bitume' => '',
                'activity_bitumpo' => '',
                'installation_allocation_imputation' => '',
                'supplier_code' => $item->supplier_code,
                'code_02_vat' => '',
                'code_u' => '',
                'quantity' => $item->quantity,
                'amount_0' => '',
                'buying_price' => $item->buying_price,
                'code_s' => '',
                'product_label' => $item->product_label,
                'code_vat_y' => '',
                'code_60121' => '',
            ]);
            array_push($exportData, $row);
        }

        return $exportData;
    }
}
