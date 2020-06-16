<?php

namespace App\Imports;

use App\Models\PetroineosBL;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;

class PetroineosBLImport implements ToModel
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
        if ($row[0] === "OT") {
            return null;
        }

        return new PetroineosBL([
            'ot' => $row[0],
            'dspc_number' => $row[1],
            'pickup_on' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[2]),
            'customs_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[3]),
            'product' => $row[4],
            'order_ref' => $row[5],
            'net_weight' => $row[6],
            'ot_sap' => $row[7],
            'buyer' => $row[8],
            'declaring' => $row[9],
            'billed' => $row[10],
            'sap_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[11]),
            'cpdp_date' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[12]),
            'recipient' => $row[13],
        ]);
    }
}
