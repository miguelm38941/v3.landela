<?php

namespace App\Imports;

use App\Models\VitolBL;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;

class VitolBLImport implements ToModel
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
        if ($row[0] === "Client") {
            return null;
        }

        return new VitolBL([
            'client' => $row[0],
            'incoterm' => $row[1],
            'product' => $row[2],
            'period' => $row[3],
            'order_number' => $row[4],
            'bl_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[5]),
            'status' => $row[6],
            'net_quantity' => $row[7],
            'uom_quantity' => $row[8],
            'ship_to' => $row[9],
            'country' => $row[10],
            'transporter' => $row[11],
        ]);
    }
}
