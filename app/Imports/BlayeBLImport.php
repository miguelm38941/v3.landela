<?php

namespace App\Imports;

use App\Models\BlayeBL;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;

class BlayeBLImport implements ToModel
{
    use Importable;

    public function model(array $row)
    {
        if (!isset($row[0]) && !isset($row[1]) && !isset($row[2])) {
            return null;
        }
        if ($row[1] === NULL) {
            return null;
        }
        if ($row[0] === "Jour du BL") {
            return null;
        }

        return new BlayeBL([
            'bl_day' => $row[0],
            'command_number' => $row[1],
            'accounting_site_code' => $row[2],
            'bl_product_code' => $row[3],
            'bl_site_code' => $row[4],
            'customer_delivery_label' => $row[5],
            'quantity' => $row[6],
        ]);
    }
}
