<?php

namespace App\Http\Controllers;

use App\Models\Installation;
use Illuminate\Http\Request;
use Spatie\Searchable\Search;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class InstallationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $installations = Installation::paginate(10);
        return view('installations.index')->with('installations', $installations)
            ->with('searchQuery', "");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('installations.create');
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

        $ue = $request->get('ue');
        $installation = DB::table('installations')->where('ue', '=', $ue)->get();
        
        if (isset($installation)) {
            return back()->with('error', 'Cette installation existe déjà');
        } else {
            $installation = new Installation([
                'ue' => $request->get('ue'),
                'ue_mnemo' => $request->get('ue_mnemo'),
                'ue_lib_installation' => $request->get('ue_lib_installation'),
                'dossier_zephyr' => $request->get('dossier_zephyr'),
                'up' => $request->get('up'),
                'up_mnemo' => $request->get('up_mnemo')
            ]);

            $installation->save();

            Alert::toast('Installation créée!', 'success');

            return redirect('/installations');
        }
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
        $installation = Installation::find($id);
        return view('installations.edit', compact('installation'));
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

        $installation = Installation::find($id);
        $installation->ue =  $request->get('ue');
        $installation->ue_mnemo = $request->get('ue_mnemo');
        $installation->ue_lib_installation = $request->get('ue_lib_installation');
        $installation->dossier_zephyr = $request->get('dossier_zephyr');
        $installation->up = $request->get('up');
        $installation->up_mnemo = $request->get('up_mnemo');
        $installation->save();

        Alert::toast('Installation sauvegardée!', 'success');

        return redirect('/installations');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $installation = Installation::find($id);
        $installation->delete();

        Alert::toast('Installation supprimée!', 'success');

        return redirect('/installations');
    }

    public function search(Request $request)
    {
        $searchQuery = $request->get('searchQuery');
        if (isset($searchQuery)) {
            $searchResults = (new Search())
                ->registerModel(Installation::class, 'ue')
                ->perform($request->input('searchQuery'));

            $titles = [];
            foreach ($searchResults as $result) {
                $title = $result->title;
                array_push($titles, $title);
            }
            $data = Installation::whereIn('ue', $titles)->paginate(10);
            return view('installations.index')->with('installations', $data)
                ->with('searchQuery', $searchQuery);
        } else {
            $data = Installation::paginate(10);
            return view('installations.index')->with('installations', $data)
                ->with('searchQuery', $searchQuery);
        }
    }
}
