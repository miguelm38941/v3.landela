<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Installation;
use App\Models\Affiliate;
use App\Models\Ert;
use App\Models\Product;
use App\Models\Supplier;
use App\Models\StandardBL;
use Config;
use Illuminate\Support\Str;
use PDF;
use Redirect;
use App\Exports\SummaryExport;
//use Maatwebsite\Excel\Excel;
use Maatwebsite\Excel\Facades\Excel;
//use Excel;
use RealRashid\SweetAlert\Facades\Alert;

class BillingProcessController extends Controller
{
    public $selected_supplier;
    public $selected_customer;
    public $selected_installation;
    public $selected_account_period;
    public $selected_invoice;

    public function __construct()
    {
    }

    function init()
    {
        $this->selected_supplier = '';
        $this->selected_customer = '';
        $this->selected_installation = '';
        $this->selected_account_period = '';
        $this->selected_invoice = '';
    }

    public function index(Request $request)
    {
        $this->selected_supplier = $request['_suppliers'];
        $this->selected_customer = $request['_ert'];
        $this->selected_installation = $request['_installations'];
        $this->selected_account_period = $request['_account_period'];
        $this->selected_invoice = $request['_invoice'];
        //dd($request['_suppliers']);
        if (isset($request['_suppliers'])) {
            $d = explode('-', $request['_account_period']);
            $s_bl = StandardBL::where([
                'supplier_label' => $request['_suppliers'],
                'customer_code' => $request['_ert'],
                'installation_code' => $request['_installations']
            ])
                ->whereYear('loadin_date', $d['0'])
                ->whereMonth('loadin_date', $d['1'])
                ->get();
            $s_bl->paginated = 'false';
            //dd($s_bl);
        } elseif (isset($request['_invoice'])) {
            if($request['_invoice']==null){
                session()->flash('error', 'Aucune facture sélectionnée');
                return Redirect::back();
            }
            if($request['_account_period']==null){
                session()->flash('error', 'Aucune période comptable sélectionnée');
                return Redirect::back();
            }
            
            $d = explode('-', $request['_account_period']);
            $billingInvoice = \App\Models\BillingExport::where('num_facture', $request['_invoice'])->first();
            $s_bl = StandardBL::where([
                'supplier_label' => $billingInvoice->supplier_label,
                'customer_code' => $billingInvoice->customer_num,
                'installation_code' => $billingInvoice->installation_code
            ])
                ->whereYear('loadin_date', $d['0'])
                ->whereMonth('loadin_date', $d['1'])
                ->get();
            $s_bl->paginated = 'false';
        } else {
            $s_bl = StandardBL::paginate(20);
            $s_bl->paginated = 'true';
        }

        $suppliers = Supplier::all();
        $customers = Ert::all();
        $installations = Installation::all();
        $factures = \App\Models\BillingExport::all();
        $factures_litteral = array();
        $inv = new \stdclass;
        $i=0;
        foreach($factures as $facture){
            $i++;
            $inv->id = $facture->id;
            $inv->num_facture = $facture->num_facture;
            $inv->supplier_label = $facture->supplier_label;
            $inv->customer_num = $facture->customer_num;
            $inv->installation_code = $facture->installation_code;
            $inv->account_period = $facture->account_period;
            $d = explode('-', $facture->account_period);
            $month = $this->getMonthLitteral($d['1']);
            $inv->account_period_label = strtoupper($month) . ' ' . $d['0'];
            $factures_litteral[$i] = $inv;
        }
        //$s_bl = \App\Models\StandardBL::paginate(20);

        $periods = $this->computePeriodsArray();

        return view('billingprocess.index')
            ->with('suppliers', $suppliers)
            ->with('selected_supplier', $this->selected_supplier)
            ->with('selected_customer', $this->selected_customer)
            ->with('selected_installation', $this->selected_installation)
            ->with('selected_account_period', $this->selected_account_period)
            ->with('selected_invoice', $this->selected_invoice)
            ->with('customers', $customers)
            ->with('installations', $installations)
            ->with('periods', $periods)
            ->with('factures', $factures)
            ->with('results', $s_bl);
    }

    private function computePeriodsArray()
    {
        $s_bl = \App\Models\StandardBL::all();
        $dates = array();
        foreach ($s_bl as $sbl) :
            //$month = $this->getMonthYear($sbl->loadin_date);
            array_push($dates, $sbl->loadin_date);
        endforeach;
        //array_unique($dates, SORT_STRING);
        //dd($dates);
        return $this->getMonthYear($dates);
    }

    private function getMonthLitteral($month_num)
    {
        $monthsArray = array('01' => 'Janvier', '02' => 'Février', '03' => 'Mars', '04' => 'Avril', '05' => 'Mai', '06' => 'Juin', '07' => 'Juillet', '08' => 'Août', '09' => 'Septembre', '10' => 'Octobre', '11' => 'Novembre', '12' => 'Décembre');
        return $monthsArray[$month_num];
    }

    private function getMonthYear($dates)
    {
        $periods = array();
        $processed = array();
        $monthsArray = array('01' => 'Janvier', '02' => 'Février', '03' => 'Mars', '04' => 'Avril', '05' => 'Mai', '06' => 'Juin', '07' => 'Juillet', '08' => 'Août', '09' => 'Septembre', '10' => 'Octobre', '11' => 'Novembre', '12' => 'Décembre');
        $i = 0;
        foreach ($dates as $date) :
            $d = explode('-', $date);
            if (!in_array($d['0'] . '-' . $d['1'], $processed)) {
                $periods[$i]['value'] = $d['0'] . '-' . $d['1'];
                $month = $this->getMonthLitteral($d['1']);
                $periods[$i]['label'] = $month . ' ' . $d['0'];
                array_push($processed, $d['0'] . '-' . $d['1']);
                $i++;
            }
        //$periods[$d['0'].'-'.$d['1']] = $monthsArray[$d['1']] . ' ' . $d['0'];
        endforeach;
        //array_unique($periods, SORT_STRING);
        return $periods;
    }

    private function getBillingData(Request $request)
    {
        $billingData = new \stdclass;

        // If affiliate data not found
        if ($request['_account_period'] == '') {
            $data = new \stdclass;
            $data->error = "Vous n\'avez choisi aucune période.";
            return $data;
        }
        $d = explode('-', $request['_account_period']);

        if($request['_invoice']==''){
            $billingData->s_bl = \App\Models\StandardBL::where([
                'supplier_label' => $request['_suppliers'],
                'customer_code' => $request['_ert'],
                'installation_code' => $request['_installations']
                ])
                ->whereYear('loadin_date', $d['0'])
                ->whereMonth('loadin_date', $d['1'])
                ->get();

            $billingData->customer = \App\Models\Ert::where('customer_number', $request['_ert']) //'customer_number', $request['_ert']
                ->first();
        }
        else{
            $billingInvoice = \App\Models\BillingExport::where('num_facture', $request['_invoice'])->first();

            $billingData->s_bl = \App\Models\StandardBL::where([
                'supplier_label' => $billingInvoice->supplier_label,
                'customer_code' => $billingInvoice->customer_num,
                'installation_code' => $billingInvoice->installation_code
                ])
                ->whereYear('loadin_date', $d['0'])
                ->whereMonth('loadin_date', $d['1'])
                ->get();

            $billingData->customer = \App\Models\Ert::where('customer_number', $billingInvoice->customer_num) //'customer_number', $request['_ert']
                ->first();
        }

        // If affiliate data not found
        if ($billingData->customer == null) {
            $data = new \stdclass;
            $data->error = "Aucune information trouvée pour ce client.";
            return $data;
        }

        $product_array = array();
        $tot_qty = 0;
        $tot_amount = 0;
        $i = 0;
        foreach ($billingData->s_bl as $sbl) :
            //var_dump($sbl->quantity);
            //if(Str::contains($sbl->loadin_date, $request['_account_period'])):
            $product_array[$i]['loadin_date'] = $sbl->loadin_date;
            $product_array[$i]['product'] = Product::where('product_code', $sbl->product_code)->first(); //152289 $sbl->product_code);
            $product_array[$i]['qty'] = number_format($sbl->quantity, '2', ',', ' ');
            //var_dump($tot_qty);
            $tot_qty = $tot_qty + $sbl->quantity;
            $product_array[$i]['unit_price'] = number_format($sbl->buying_price, '2', ',', ' ');
            $product_array[$i]['total_price'] = number_format($sbl->quantity * $sbl->buying_price, '2', ',', ' ');
            $tot_amount = $tot_amount + ($sbl->quantity * $sbl->buying_price);
            $i++;
        //endif;
        endforeach;
        //exit;
        //dd($tot_qty);
        $billingData->products = $product_array;
        $billingData->tot_qty = number_format($tot_qty, '2', ',', ' ');;
        $billingData->tot_amount = number_format($tot_amount, '2', ',', ' ');
        $billingData->tot_amount_tax = number_format($tot_amount * 0.2, '2', ',', ' ');
        $billingData->tot_billing_amount = number_format($tot_amount + ($tot_amount * 0.2), '2', ',', ' ');
        $billingData->customer = Ert::where('identifier', $request['ert'])->first();
        $billingData->num_intra_com = Config::get('misc.num_intra_com');

        $d = explode('-', $request['_account_period']);
        $month = $this->getMonthLitteral($d['1']);
        $billingData->account_period = strtoupper($month) . ' ' . $d['0'];

        $billingData->date = $this->computeBillingDates();

        return $billingData;
    }

    public function displayInvoice(Request $request)
    {
        $billingData = $this->getBillingData($request);
        $billingData->billing_number = $this->getBillingNumber();
        //dd($request->suppliers);
        return view('billingprocess.display_invoice')->with('billing_data', $billingData);
    }

    public function viewCreditInvoice($billingData)
    {
        $billingData->billing_number = $this->getBillingNumber();
        //dd($request->suppliers);
        return view('billingprocess.display_invoice')->with('billing_data', $billingData);
    }

    private function getCreditInvoiceData($billingInvoice)
    {
        $billingData = new \stdclass;

        // If affiliate data not found
        if ($billingInvoice->account_period == '') {
            $data = new \stdclass;
            $data->error = "Vous n\'avez choisi aucune période.";
            return $data;
        }

        $billingData->creditInvoices = \App\CreditExport::where('num_facture',$billingInvoice->num_facture)->get();

        $product_array = array();
        $tot_qty = 0;
        $tot_amount = 0;
        $i = 0;
        foreach ($billingData->creditInvoices as $c_invoice) :
            //var_dump($sbl->quantity);
            //if(Str::contains($sbl->loadin_date, $request['_account_period'])):
            //$product_array[$i]['loadin_date'] = $sbl->loadin_date;
            $product_array[$i]['product'] = Product::where('product_code', $c_invoice->product_code)->first(); //152289 $sbl->product_code);
            $product_array[$i]['qty'] = number_format($c_invoice->product_qty, '2', ',', ' ');
            //var_dump($tot_qty);
            $tot_qty = $tot_qty + $c_invoice->product_qty;
            $product_array[$i]['unit_price'] = number_format($c_invoice->product_price, '2', ',', ' ');
            $product_array[$i]['total_price'] = number_format($c_invoice->product_qty * $c_invoice->product_price, '2', ',', ' ');
            $tot_amount = $tot_amount + ($c_invoice->product_qty * $c_invoice->product_price);
            $i++;
        //endif;
        endforeach;
        //exit;
        //dd($tot_qty);
        $billingData->products = $product_array;

        $billingData->customer = \App\Models\Ert::where('customer_number', $billingInvoice->customer_num) //'customer_number', $request['_ert']
            ->first();
        // If affiliate data not found
        if ($billingData->customer == null) {
            $data = new \stdclass;
            $data->error = "Aucune information trouvée pour ce client.";
            return $data;
        }

        $billingData->tot_qty = number_format($tot_qty, '2', ',', ' ');;
        $billingData->tot_amount = number_format($tot_amount, '2', ',', ' ');
        $billingData->tot_amount_tax = number_format($tot_amount * 0.2, '2', ',', ' ');
        $billingData->tot_billing_amount = number_format($tot_amount + ($tot_amount * 0.2), '2', ',', ' ');
        //$billingData->customer = Ert::where('identifier', $request['ert'])->first();
        $billingData->num_intra_com = Config::get('misc.num_intra_com');

        $d = explode('-', $billingInvoice->account_period);
        $month = $this->getMonthLitteral($d['1']);
        $billingData->account_period = strtoupper($month) . ' ' . $d['0'];

        $billingData->date = $this->computeBillingDates();

        return $billingData;
    }

    public function displayCreditInvoice($num_facture)
    { 
        $billingInvoice = \App\Models\BillingExport::where('num_facture', $num_facture)->first();
        //dd($billingInvoice);
        $billingData = $this->getCreditInvoiceData($billingInvoice);
        //dd($billingData);
        $billingData->billing_number = $this->getBillingNumber();
        //dd($request->suppliers);
        return view('billingprocess.display_invoice')->with('billing_data', $billingData);
    }

    public function createCreditInvoice(Request $request)
    {
        if($request['_invoice']==null){
            session()->flash('error', 'Aucune facture sélectionnée');
            return Redirect::back();
        }
        $invoice = \App\Models\BillingExport::where('num_facture', $request['_invoice'])->first();
        $products = \App\Models\Product::all()->sortBy('product_label');
        $creditInvoices = \App\CreditExport::where('num_facture',$request['_invoice'])->get();

        $invoices_array = array();
        foreach($creditInvoices as $credit):
            $inv = new \stdclass();
            $product = \App\Models\Product::where('product_code', $credit->product_code)->first();
            $inv->id = $credit->id;
            $inv->product = $product;
            $inv->product_price = $credit->product_price;
            $inv->product_qty = $credit->product_qty;
            $invoices_array[] = $inv;
        endforeach;
//dd($invoices_array);
        return view('billingprocess.create_credit_invoice')
                ->with('invoice', $invoice)
                ->with('products', $products)
                ->with('credit_invoices', $invoices_array);
    }

    public function processAddCreditItem(Request $request)
    {

        $creditInvoice = new \App\CreditExport();
        $creditInvoice->num_facture = $request['num_facture'];
        $creditInvoice->product_code = $request['product_code'];
        $creditInvoice->product_qty = $request['product_qty'];
        $creditInvoice->product_price = $request['product_price'];
        $creditInvoice->save();

        $creditInvoices = \App\CreditExport::where('num_facture',$request['num_facture'])->get();
        //dd($creditInvoices);        
        $html = ''; 
        foreach($creditInvoices as $credit):
            $product = \App\Models\Product::where('product_code', $credit->product_code)->first();
            $html .= '
                <li class="list-group-item">
                <div class="row col-sm-12">
                    <div class="col-sm-9">
                    <h5 class="d-inline-block align-middle"><b>'.$product->product_label.', '.$product->supplier_code.', '.$product->rafael_product_label.'</b></h5>
                    <h6><b>Quantité:</b> '.$credit->product_qty.' - <b>Prix unit.:</b> '.$credit->product_price.' </h6>
                    </div>
                    <div class="col-sm-3 btn-group">
                        <button data-id="{{ $inv->id }}" class="delete-credit-item btn btn-sm btn-danger">Retirer</button>
                    </div>
                </div>
                </li>
            '; 
        endforeach;

        echo $html;
    }

    public function deleteCreditItem(Request $request)
    {
        $credit = \App\CreditExport::find($request['id']);
        $credit->delete();

        $creditInvoices = \App\CreditExport::where('num_facture',$request['num_facture'])->get();
        //dd($creditInvoices);        
        $html = ''; 
        foreach($creditInvoices as $credit):
            $product = \App\Models\Product::where('product_code', $credit->product_code)->first();
            $html .= '
                <li class="list-group-item">
                <div class="row col-sm-12">
                    <div class="col-sm-9">
                    <h5 class="d-inline-block align-middle"><b>'.$product->product_label.', '.$product->supplier_code.', '.$product->rafael_product_label.'</b></h5>
                    <h6><b>Quantité:</b> '.$credit->product_qty.' - <b>Prix unit.:</b> '.$credit->product_price.' </h6>
                    </div>
                    <div class="col-sm-3 btn-group">
                        <button data-id="{{ $inv->id }}" class="delete-credit-item btn btn-sm btn-danger">Retirer</button>
                    </div>
                </div>
                </li>
            '; 
        endforeach;
//dd($html);
        echo $html;
        //return Redirect::back();
    }

    public function exportSummaryXLS(Request $request)
    {
        $billingData = $this->getBillingData($request);

        if (!isset($billingData->error)) {
            //*********************/
            /* CREATE XLS HERE */
            /****************/
            //return view('billingprocess.summary_layout')->with('billing_data', $billingData);            
            return Excel::download(new SummaryExport($billingData), 'facture.xlsx');
        } else {
            session()->flash('error', $billingData->error);
            return Redirect::back();
        }
    }

    public function exportCreditSummaryXLS(Request $request)
    {
        //dd($request['num_facture']);
        $billingData = $this->getBillingData($request);

        if (!isset($billingData->error)) {
            //*********************/
            /* CREATE XLS HERE */
            /****************/
            return Excel::download(new SummaryExport($billingData), 'facture.xlsx');
        } else {
            session()->flash('error', $billingData->error);
            return Redirect::back();
        }
    }

    public function exportSummaryPDF(Request $request)
    {
        $billingData = $this->getBillingData($request);

        if (!isset($billingData->error)) {
        
            $view = \View::make('billingprocess.summary_layout_pdf', ['billing_data' => $billingData]);
            $html_content = $view->render();
            PDF::SetTitle("List of users");
            PDF::AddPage();
            PDF::writeHTML($html_content, true, false, true, false, '');
            // D is the change of these two functions. Including D parameter will avoid 
            // loading PDF in browser and allows downloading directly
            
            PDF::Output('invoice_summary' . $billingData->account_period . '.pdf', 'D');
        } else {
            session()->flash('error', $billingData->error);
            return Redirect::back();
        }
    }

    public function exportCreditSummaryPDF(Request $request)
    {
        //dd($request['num_facture']);
        $billingData = $this->getBillingData($request);
        //$billingData = $this->getCreditInvoiceData($request['_invoice']);
        
        if (!isset($billingData->error)) {
            $view = \View::make('billingprocess.summary_layout_pdf', ['billing_data' => $billingData]);
            $html_content = $view->render();
            PDF::SetTitle("List of users");
            PDF::AddPage();
            PDF::writeHTML($html_content, true, false, true, false, '');
            // D is the change of these two functions. Including D parameter will avoid 
            // loading PDF in browser and allows downloading directly
            PDF::Output('invoice_summary' . $billingData->account_period . '.pdf', 'D');
        } else {
            session()->flash('error', $billingData->error);
            return Redirect::back();
        }
    }

    public function exportCreditPDF($show, $num_facture)
    {
        $invoice = \App\Models\BillingExport::where([
            'num_facture' => $num_facture
        ])->get();

        $billingData = $this->getCreditInvoiceData($invoice[0]);

        if (!isset($billingData->error)) {
            $billingData->billing_number = $this->getBillingNumber();

            $view = \View::make('billingprocess.invoice_layout', ['billing_data' => $billingData]);
            $html_content = $view->render();
            PDF::SetTitle("List of users");
            PDF::AddPage();
            PDF::writeHTML($html_content, true, false, true, false, '');
            // D is the change of these two functions. Including D parameter will avoid 
            // loading PDF in browser and allows downloading directly
            //return view('billingprocess.invoice_layout')->with('billing_data', $billingData);
            if ($show == 'show') {
                PDF::Output('invoice' . $billingData->billing_number . '.pdf');
            } else {
                PDF::Output('invoice' . $billingData->billing_number . '.pdf', 'D');
            }
        } else {
            session()->flash('error', $billingData->error);
            return Redirect::back();
        }
    }

    public function exportInvoicePDF(Request $request, $show)
    {
        $invoice = \App\Models\BillingExport::where([
            'supplier_label' => $request['_suppliers'],
            'customer_num' => $request['_ert'],
            'installation_code' => $request['_installations'],
            'account_period' => $request['_account_period']
        ])
            ->get();

        $billingData = $this->getBillingData($request);

        if (!isset($invoice[0]->id) && !isset($billingData->error)) {

            $num_facture = $this->getBillingNumber();
            $bill = new \App\Models\BillingExport();
            $bill->supplier_label = $request['_suppliers'];
            $bill->customer_num = $request['_ert'];
            $bill->installation_code = $request['_installations'];
            $bill->account_period = $request['_account_period'];
            $bill->num_facture = $num_facture;
            if (!$bill->save()) {
                session()->flash('error', 'Une erreur est survenue. Veuillez réessayer plus tard.');
                return Redirect::back();
            }
        }

        if (!isset($billingData->error)) {
            $billingData->billing_number = isset($invoice[0]->num_facture) ? $invoice[0]->num_facture : $num_facture;
            $view = \View::make('billingprocess.invoice_layout', ['billing_data' => $billingData]);
            $html_content = $view->render();
            PDF::SetTitle("List of users");
            PDF::AddPage();
            PDF::writeHTML($html_content, true, false, true, false, '');
            // D is the change of these two functions. Including D parameter will avoid 
            // loading PDF in browser and allows downloading directly
            if ($show == 'show') {
                PDF::Output('invoice' . $billingData->billing_number . '.pdf');
            } else {
                PDF::Output('invoice' . $billingData->billing_number . '.pdf', 'D');
            }
        } else {
            session()->flash('error', $billingData->error);
            return Redirect::back();
        }
    }

    private function computeBillingDates()
    {
        $date = new \stdclass;
        $now = \Carbon\Carbon::now();
        $date->today = $now->format('d-m-Y');

        $date->echeance = $now->copy()->addDays(30);
        if ($date->echeance->dayOfWeek == 6) {
            $date->echeance = $now->copy()->addDays(31);
        } elseif ($date->echeance->dayOfWeek == 7) {
            $date->echeance = $now->copy()->addDays(32);
        }
        $date->echeance = $date->echeance->format('d-m-Y');
        return $date;
    }

    private function getBillingNumber()
    {
        // Get the new number from billing Export table
        // Esle, get the initial value from config file
        $maxInvNumber = \App\Models\BillingExport::all()->max('num_facture');

        if (isset($maxInvNumber))
            return (int) $maxInvNumber + 1;
        return Config::get('misc.billing_init_number');
    }

}
