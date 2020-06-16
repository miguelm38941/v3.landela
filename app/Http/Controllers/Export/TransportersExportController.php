<?php

namespace App\Http\Controllers\Export;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Http\Request;

class TransportersExportController extends Controller
{
    public function export(Request $request, $selected_supplier)
    {
        $selected_customer = $request->selectedCustomer;
        $selected_installation = $request->selectedInstallation;
        $selected_account_period = $request->selectedAccountPeriod;

        $dirPath = "app/exports/";
        File::deleteDirectory(storage_path($dirPath));
        File::makeDirectory(storage_path($dirPath), 0777, true, true);

        $fileName = "Export " . strtoupper($selected_supplier) . " TRANSPORT " . date("dmY") . ".IRI";
        $path = storage_path('app/exports/' . $fileName);
        self::createExportFile($selected_supplier, $selected_customer, $selected_installation, $selected_account_period, $path, $fileName);

        return response()->download($path, $fileName);
    }

    public function createExportFile($selected_supplier,  $selected_customer, $selected_installation, $selected_account_period, $path, $fileName)
    {
        $handle = fopen($path, 'w') or die('Cannot open file:  ' . $fileName);

        $data = self::getData($selected_supplier,  $selected_customer, $selected_installation, $selected_account_period);
   
        foreach ($data as $item) {
            $row = $item->loadin_date . "|" . $item->delivery_note . "||" . 'TRANSPOR' . "     |" . "TRPACHAT  " . "|BITUMPO     " . "||" . $item->supplier_code . "|" . $item->supplier_code . "|" . "02" . "|U| " . $item->quantity . "| " . "0000000,000" . "| " . $item->buying_price . "| " . "0000000,00" . "|S|" . 'TRANSPORT SELON CONTRAT' . "       |||" . "BITUME" . "|Y|62410 ||||" . "\n";
            fwrite($handle, $row);
        }
    }

    function getData($selected_supplier,  $selected_customer, $selected_installation, $selected_account_period)
    {
        if ($selected_customer === 'Filiale') {
            $selected_customer = '';
        }
        if ($selected_installation === 'Installations') {
            $selected_installation = '';
        }

        $query = DB::table('standard_b_l_s');
        if (isset($selected_supplier) && !empty($selected_supplier)) {
            $query->where('supplier_label', '=', $selected_supplier);
        }
        if (isset($selected_customer) && !empty($selected_customer)) {
            $query->where('customer_code', '=', $selected_customer);
        }
        if (isset($selected_installation) && !empty($selected_installation)) {
            $query->where('installation_code', '=', $selected_installation);
        }
        if (isset($selected_account_period) && !empty($selected_account_period)) {
            $periods = explode("/", $selected_account_period);
            $start_date_str = $periods[1] . '-' . $periods[0] . '-' . '01';
            $start_date = date_create($start_date_str);
            $end_date_str = $periods[1] . '-' . $periods[0] . '-' . '31';
            $end_date = date_create($end_date_str);

            $query->whereBetween('loadin_date', [$start_date, $end_date]);
        }
        return $query->get();
    }
}
