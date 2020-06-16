<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Supplier;
use App\Models\BlayeBL;
use App\Models\PetroineosBL;
use App\Imports\BlayeBLImport;
use App\Imports\PetroineosBLImport;
use Maatwebsite\Excel\Facades\Excel;


class UploadFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        self::cleanTempsTables();
        $suppliers = Supplier::all();
        return view('fileutil.upload_file')->with('suppliers', $suppliers);
    }

    //TODO
    public function uploadfile(Request $request) {
        if ($request->hasFile('blfile')) {
            $supplier_name = $request->suppliers;
            $extension = $request->blfile->extension();
            $filename = "BL".date("Ymd").date("his").".".$extension;
            $path = $request->blfile->storeAs('uploads', $filename);
            //we will import excel data and save the result in a temp table
            if ($supplier_name == "Blaye") {
                return self::importBlayeBL($path);
            } else if ($supplier_name == "Petroineos") {
                return self::importPetroineosBL($path);
            }
        } else {
           return $this->index(); 
        }
        
    }

    function importBlayeBL($path) {
        Excel::import(new BlayeBLImport, $path);
        $results = BlayeBL::all();
        return view('fileutil.blaye_bl_import_results')->with('results', $results)
                                                 ->with('supplier', 'Blaye');
    }

    function importPetroineosBL($path) {
        Excel::import(new PetroineosBLImport, $path);
        $results = PetroineosBL::all();
        return view('fileutil.petroineos_bl_import_results')->with('results', $results)
                                                 ->with('supplier', 'Petroineos');
    }

    function importShellBL($path) {

    }

    function cleanTempsTables() {
        DB::table('blaye_b_l_s')->truncate();
        DB::table('petroineos_b_l_s')->truncate();
        // BlayeBL::delete();
        // PetroineosBL::delete();
    }
}
