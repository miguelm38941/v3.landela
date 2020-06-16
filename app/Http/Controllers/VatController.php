<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vat;
use RealRashid\SweetAlert\Facades\Alert;
class VatController extends Controller
{
      /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vats = Vat::paginate(10);
        return view('vats.index', compact('vats'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vats.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'ue'=>'required',
        // ]);

        $vat = new Vat([
            'refinery_code' => $request->get('refinery_code'),
            'refinery_label' => $request->get('refinery_label'),
            'supplier_code' => $request->get('supplier_code'),
            'vat_code' => $request->get('vat_code'),
            'vat_value' => $request->get('vat_value'),
            'rafael_vat_code' => $request->get('rafael_vat_code')
        ]);
        $vat->save();
        
        Alert::toast('TVA créée!', 'success');

        return redirect('/vats');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $vat = Vat::find($id);
        return view('vats.edit', compact('vat')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // $request->validate([
        //     'ue'=>'required',
        // ]);

        $vat = Vat::find($id);
        $vat->refinery_code =  $request->get('refinery_code');
        $vat->refinery_label = $request->get('refinery_label');
        $vat->supplier_code = $request->get('supplier_code');
        $vat->vat_code = $request->get('vat_code');
        $vat->vat_value = $request->get('vat_value');
        $vat->rafael_vat_code = $request->get('rafael_vat_code');
        $vat->save();
        
        Alert::toast('TVA sauvegardée!', 'success');

        return redirect('/vats');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $vat = Vat::find($id);
        $vat->delete();

        Alert::toast('TVA supprimée!', 'success');

        return redirect('/vats');
    }
}
