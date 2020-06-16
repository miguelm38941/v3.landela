<?php

namespace App\Imports;

use App\Models\VitolBL;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;

class ShellBLImport implements ToModel
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
        if ($row[0] === "Delivery") {
            return null;
        }

        return new VitolBL([
            'delivery' => $row[0],
            'shipment' => $row[1],
            'purchase_order_number' => $row[2],
            'sale_order' => $row[3],
            'sold_to_pt' => $row[4],
            'name_of_sold_to_party' => $row[5],
            'ship_to' => $row[6],
            'name_of_the_ship_to_party' => $row[7],
            'location_of_the_ship_to_party' => $row[8],
            'material' => $row[9],
            'description' => $row[10],
            'total_weight' => $row[11],
            'wun' => $row[12],
            'plnt' => $row[13],
            'plant' => $row[14],
            'loadg_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[15]),
            'delivery_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[16]),
            'bill_doc' => $row[17],
            'price_ht' => $row[18],

        ]);
    }
}
