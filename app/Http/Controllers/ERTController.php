<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ert;
use RealRashid\SweetAlert\Facades\Alert;

class ERTController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $erts = Ert::paginate(10);
        return view('erts.index', compact('erts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('erts.create');
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
        //     'identifier' => 'required',
        //     'label' => 'required',
        // ]);
        $ert = new Ert([
            'alternate_code' => $request->alternate_code,
            'identifier' => $request->identifier,
            'label' => $request->label,
            'customer_number' => $request->customer_number,
            'address1' => $request->address1,
            'address2' => $request->address2,
            'zip_code' => $request->zip_code,
            'city' => $request->city,
            'country' => $request->country,
            'payment_mode' => $request->payment_mode,
            'vat_number' => $request->vat_number
        ]);
        $ert->save();

        Alert::toast('Filiale créée!', 'success');

        return redirect('/erts');
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
        $ert = Ert::find($id);
        return view('erts.edit', compact('ert'));
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
        //     'identifier' => 'required',
        //     'label' => 'required',
        // ]);
        $ert = Ert::find($id);
        $ert->alternate_code = $request->alternate_code;
        $ert->identifier =  $request->identifier;
        $ert->label = $request->label;
        $ert->customer_number = $request->customer_number;
        $ert->address1 = $request->address1;
        $ert->address2 = $request->address2;
        $ert->zip_code = $request->zip_code;
        $ert->city = $request->city;
        $ert->country = $request->country;
        $ert->payment_mode = $request->payment_mode;
        $ert->vat_number = $request->vat_number;
        $ert->save();

        Alert::toast('Filiale sauvegardée!', 'success');

        return redirect('/erts');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $ert = Ert::find($id);
        $ert->delete();

        Alert::toast('Filiale supprimée!', 'success');

        return redirect('/erts');
    }
}
