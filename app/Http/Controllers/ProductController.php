<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::paginate(10);
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'ue' => 'required',
        ]);

        $product = new Product([
            'product_code' => $request->get('product_code'),
            'product_label' => $request->get('product_label'),
            'rafael_product_code' => $request->get('rafael_product_code'),
            'rafael_product_label' => $request->get('rafael_product_label'),
            'supplier_code' => $request->get('supplier_code'),
            'refinery_code' => $request->get('refinery_code'),
            'refinery_label' => $request->get('refinery_label')
        ]);
        $product->save();

        Alert::toast('Produit crée!', 'success');

        return redirect('/products');
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
        $product = Product::find($id);
        return view('products.edit', compact('product'));
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
        $request->validate([
            'ue' => 'required',
        ]);

        $product = Product::find($id);
        $product->ue =  $request->get('product_code');
        $product->ue_mnemo = $request->get('product_label');
        $product->ue_lib_product = $request->get('rafael_product_code');
        $product->dossier_zephyr = $request->get('rafael_product_label');
        $product->up = $request->get('supplier_code');
        $product->up_mnemo = $request->get('refinery_code');
        $product->up_mnemo = $request->get('refinery_label');
        $product->save();

        Alert::toast('Produit sauvegardé!', 'success');

        return redirect('/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);
        $product->delete();

        Alert::toast('Produit supprimé!', 'success');

        return redirect('/products');
    }
}
