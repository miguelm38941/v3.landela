<?php

namespace App\Http\Controllers\Export;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use ZipArchive;
use Illuminate\Http\Request;

class SupplierExportAllController extends Controller
{
    public $dir_path = '';
    public $zipFileName = '';

    public function export(Request $request, $selectedSupplier)
    {
        $selected_customer = $request->selectedCustomer;
        $selected_installation = $request->selectedInstallation;
        $selected_account_period = $request->selectedAccountPeriod;

        $date = date("dmY");
        $this->dir_path = "app/exports/";
        File::deleteDirectory(storage_path($this->dir_path));
        File::makeDirectory(storage_path($this->dir_path), 0777, true, true);

        self::exportSupplier($selectedSupplier, $selected_customer, $selected_installation, $selected_account_period, $date);
        self::exportSupplierInclude($selectedSupplier, $selected_customer, $selected_installation, $selected_account_period, $date);
        self::exportTransporters($selectedSupplier, $selected_customer, $selected_installation, $selected_account_period, $date);

        $path = self::createZipFile($selectedSupplier, $date);

        // We return the file immediately after download
        return response()->download($path);
    }

    function exportSupplier($selected_supplier, $selected_customer, $selected_installation, $selected_account_period, $date)
    {
        $fileName = "Export " . strtoupper($selected_supplier) . " " . $date . ".IRI";
        $path = storage_path($this->dir_path . $fileName);

        $supplierExport = new SupplierExportController();
        $supplierExport->createExportFile($selected_supplier,  $selected_customer, $selected_installation, $selected_account_period, $path, $fileName);
    }

    function exportSupplierInclude($selected_supplier, $selected_customer, $selected_installation, $selected_account_period, $date)
    {
        $fileName = "Export " . strtoupper($selected_supplier) . " TRANSPORT INCLUDE " . $date . ".IRI";
        $path = storage_path($this->dir_path . $fileName);

        $supplierIncludeExport = new SupplierIncludeExportController();
        $supplierIncludeExport->createExportFile($selected_supplier,  $selected_customer, $selected_installation, $selected_account_period, $path, $fileName);
    }

    function exportTransporters($selected_supplier, $selected_customer, $selected_installation, $selected_account_period, $date)
    {
        $fileName = "Export " . strtoupper($selected_supplier) . " TRANSPORT " . $date . ".IRI";
        $path = storage_path($this->dir_path . $fileName);

        $transportersExport = new TransportersExportController();
        $transportersExport->createExportFile($selected_supplier,  $selected_customer, $selected_installation, $selected_account_period, $path, $fileName);
    }

    function createZipFile($selectedSupplier, $date)
    {
        $zip = new ZipArchive;

        $this->zipFileName = strtoupper($selectedSupplier) . "-" . $date . '.zip';
        $path = storage_path($this->dir_path . $this->zipFileName);

        if ($zip->open(storage_path($this->dir_path . $this->zipFileName), ZipArchive::CREATE) === TRUE) {
            $files = File::files(storage_path($this->dir_path));

            foreach ($files as $key => $value) {
                $relativeNameInZipFile = basename($value);
                $zip->addFile($value, $relativeNameInZipFile);
            }
            $zip->close();
        }

        return $path;
    }
}
