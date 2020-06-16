<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Installation;
use App\Models\Ert;
use App\Models\Supplier;


class ConfigurationController extends Controller
{
    public $selected_supplier;
    public $selected_ert;
    public $selected_installation;

    function init()
    {
        $this->selected_supplier = '';
        $this->selected_ert = '';
        $this->selected_installation = '';
    }

    public function index()
    {
        $suppliers = Supplier::all();
        $erts = Ert::all();
        $installations = Installation::all();

        return view('configuration.index')
            ->with('suppliers', $suppliers)
            ->with('selected_supplier', $this->selected_supplier)
            ->with('selected_ert', $this->selected_ert)
            ->with('selected_installation', $this->selected_installation)
            ->with('erts', $erts)
            ->with('installations', $installations);
    }
}
