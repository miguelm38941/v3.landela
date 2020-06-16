<?php

namespace App\Http\Controllers;

use App\Models\BLTemplates;
use App\Helpers\UploadFileHelper;
use Illuminate\Http\Request;
use App\Models\Supplier;
use Illuminate\Support\Facades\DB;
use App\Models\StandardBL;
use App\Models\Ert;
use App\Imports\BlayeBLImport;
use App\Imports\PetroineosBLImport;
use App\Imports\VitolBLImport;
use App\Imports\StandardBLImport;
use App\Models\Installation;
use App\Models\UserAction;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class DeliveryProcessController extends Controller
{
    public $results;
    public $nbr_imported_lines;
    public $selected_template;
    public $selected_supplier;
    public $selected_customer;
    public $selected_refinery;
    public $selected_process_type;
    public $selected_installation;

    public function __construct()
    {
        $this->middleware('auth');
        self::init();
    }

    function init()
    {
        $this->results;
        $this->nbr_imported_lines = 0;
        $this->selected_template = '';
        $this->selected_supplier = '';
        $this->selected_customer = '';
        $this->selected_account_period = '';
        $this->selected_refinery = '';
        $this->selected_process_type = '';
        $this->selected_installation = '';
    }

    public function index()
    {
        $suppliers = Supplier::all();
        $customers = Ert::all();
        $installations = Installation::all();
        $templates = BLTemplates::all();

        $user_action = self::getCurrentUserAction();
        if (isset($user_action)) {
            $this->selected_template = $user_action->template;
        }

        $nbr_imported_lines = sizeof(self::getData($this->selected_template));

        return view('deliveryprocess.index')->with('suppliers', $suppliers)
            ->with('selected_template', $this->selected_template)
            ->with('selected_supplier', $this->selected_supplier)
            ->with('selected_customer', $this->selected_customer)
            ->with('selected_refinery', $this->selected_refinery)
            ->with('selected_account_period', $this->selected_account_period)
            ->with('selected_process_type', $this->selected_process_type)
            ->with('selected_installation', $this->selected_installation)
            ->with('nbr_imported_lines', $nbr_imported_lines)
            ->with('results', $this->results)
            ->with('customers', $customers)
            ->with('installations', $installations)
            ->with('templates', $templates);
    }

    public function uploadFile(Request $request)
    {
        // $request->validate([
        //     'blfile' => 'required',
        //     'suppliers' => 'required'
        // ]);
        if ($request->hasFile('blfile')) {
            self::disableOldUserAction();

            $user_action = new UserAction();
            $user_action->username = self::getCurrentUser();
            $user_action->enabled = true;
            $user_action->start_date = self::getCurrentDate();
            $user_action->action = "IMPORT_BL";

            $this->selected_template = $request->templates;
            $this->selected_supplier = $request->suppliers;
            $this->selected_customer = $request->customer;
            $this->selected_refinery = $request->refinery;
            $this->selected_process_type = $request->process_type;
            $this->selected_installation = $request->installation;
            $this->selected_account_period = $request->account_period;

            $uploadHelper = new UploadFileHelper();
            $path = $uploadHelper->uploadAndStoreFile($request);

            $this->results = [];
            if ($this->selected_template == "Blaye") {
                Excel::import(new BlayeBLImport, $path);
            } else if ($this->selected_template == "Petroineos") {
                Excel::import(new PetroineosBLImport, $path);
            } else if ($this->selected_template == "Vitol") {
                Excel::import(new VitolBLImport, $path);
            } else if ($this->selected_template == "Standard") {
                Excel::import(new StandardBLImport, $path);
            }

            $user_action->template = $this->selected_template;
            $user_action->end_date = self::getCurrentDate();
            //number of imported lines
            $results = DB::table('standard_b_l_s')->whereBetween('created_at', [$user_action->start_date, $user_action->end_date])->get();
            $nbr_imported_lines = sizeof($results);
            $user_action->nbr_imported_lines = $nbr_imported_lines;
            $user_action->save();

            Alert::success('Import effectué avec succès', $nbr_imported_lines . ' lignes importées');

            return redirect('/delivery-process');
        }
    }

    public function refreshForm()
    {
        self::init();
        self::disableOldUserAction();
        return self::index();
    }

    function getData($selected_template)
    {
        $table_name = '';
        $user_action = self::getCurrentUserAction();
        if ($selected_template == '' && isset($user_action)) {
            $selected_template = $user_action->template;
        }
        if ($selected_template == "Suppliers") {
            $selected_template = "Standard";
        }

        if ($selected_template == "Blaye") {
            $table_name = 'blaye_b_l_s';
        } else if ($selected_template == "Petroineos") {
            $table_name = 'petroineos_b_l_s';
        } else if ($selected_template == "Vitol") {
            $table_name = 'vitol_b_l_s';
        } else if ($selected_template == "Standard") {
            $table_name = 'standard_b_l_s';
        }

        if (isset($user_action)) {
            return DB::table($table_name)->whereBetween('created_at', [$user_action->start_date, $user_action->end_date])->get();
        } else {
            return [];
        }
    }

    public function showData(Request $request)
    {
        $this->selected_supplier = $request->suppliers;
        $this->selected_refinery = $request->refinery;
        $this->selected_process_type = $request->process_type;
        $this->selected_customer = $request->customers;
        $this->selected_installation = $request->installations;
        $this->selected_account_period = $request->account_period;

        if ($this->selected_supplier === 'Fournisseurs') {
            $this->selected_supplier = '';
        }
        if ($this->selected_customer === 'Filiale') {
            $this->selected_customer = '';
        }
        if ($this->selected_installation === 'Installations') {
            $this->selected_installation = '';
        }

        $selected_process_type = '0';
        if ($this->selected_process_type === 'Transport Inclus') {
            $this->selected_process_type = '';
        } else {
            if ($this->selected_process_type == 'Oui') {
                $selected_process_type = '1';
            }
        }

        if (isset($this->selected_supplier)) {
            $query = DB::table('standard_b_l_s');
            if (isset($this->selected_supplier) && !empty($this->selected_supplier)) {
                $query->where('supplier_label', '=', $this->selected_supplier);
            }
            if (isset($this->selected_customer) && !empty($this->selected_customer)) {
                $query->where('customer_code', '=', $this->selected_customer);
            }
            if (isset($this->selected_installation) && !empty($this->selected_installation)) {
                $query->where('installation_code', '=', $this->selected_installation);
            }
            if (isset($this->selected_process_type) && !empty($this->selected_process_type)) {
                $query->where('transport_include', '=', $selected_process_type);
            }
            if (isset($this->selected_account_period) && !empty($this->selected_account_period)) {
                $periods = explode("/", $this->selected_account_period);
                $start_date_str = $periods[1] . '-' . $periods[0] . '-' . '01';
                $start_date = date_create($start_date_str);
                $end_date_str = $periods[1] . '-' . $periods[0] . '-' . '31';
                $end_date = date_create($end_date_str);

                $query->whereBetween('loadin_date', [$start_date, $end_date])->get();
            }
            $this->results = $query->paginate(10);
        } else {
            $this->results = DB::table('standard_b_l_s')->get();
        }
        return self::index();
    }

    function disableOldUserAction()
    {
        DB::table('user_actions')
            ->where('username', '=', self::getCurrentUser())
            ->where('enabled', '=', true)
            ->update(['enabled' => false]);
    }

    function getCurrentUser()
    {
        $user = Auth::user();
        return $user->username;
    }

    function getCurrentUserAction()
    {
        $user_action = DB::table('user_actions')
            ->where('username', '=', self::getCurrentUser())
            ->where('enabled', '=', true)
            ->get();
        if (isset($user_action) && sizeof($user_action) > 0) {
            return $user_action[0];
        }
        return null;
    }

    function getCurrentDate()
    {
        $now = new \DateTime();
        return $now = date_format($now, 'Y-m-d H:i:s');
    }

    public function editStandardBL($id)
    {
        $result = StandardBL::find($id);
        if ($result->transport_include == true) {
            $result->transport_include = 'Oui';
        } else {
            $result->transport_include = 'Non';
        }
        return view('deliveryprocess.standard_edit', compact('result'));
    }

    public function updateStandardBL($id, Request $request)
    {
        $result = StandardBL::find($id);
        $result->delivery_note = $request->delivery_note;
        $result->purchase_order = $request->purchase_order;
        $result->supplier_code = $request->supplier_code;
        $result->supplier_label = $request->supplier_label;
        $result->refinery_code = $request->refinery_code;
        $result->refinery_label = $request->refinery_label;
        $result->installation_code = $request->installation_code;
        $result->installation_label = $request->installation_label;
        $result->customer_code = $request->customer_code;
        $result->customer_label = $request->customer_label;
        $result->product_code = $request->product_code;
        $result->product_label = $request->product_label;
        $result->loadin_date = $request->loadin_date;
        $result->transporter_code = $request->transporter_code;
        $result->transporter_label = $request->transporter_label;
        if ($request->transport_include === 'Oui') {
            $result->transport_include = true;
        } else {
            $result->transport_include = false;
        }
        $result->quantity = $request->quantity;
        $result->buying_price = $request->buying_price;
        $result->transport_rate = $request->transport_rate;
        $result->selling_price = $request->selling_price;
        $result->code_customer_to_invoce = $request->code_customer_to_invoce;
        $result->save();

        Alert::toast('Mise à jour effectuée!', 'success');

        return self::index();
    }
}
