<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Ordonnance;
use \App\OrdonnanceProduit;

class OrdonnancesController extends Controller
{
    public function index(int $id=null, $filter, $tag)
    {
        if ($filter=='all'):
            if (Auth::user()->isMedecin()):
                $ordonnances = Ordonnance::where('medecin_id', $id)->get()->paginate(10);
            elseif (Auth::user()->isPvv()):
                $ordonnances = Ordonnance::where('pvv_id', $id)->get()->paginate(10);
            elseif (Auth::user()->isPrepose()):
                $ordonnances = Ordonnance::where('prepose_id', $id)->get()->paginate(10);
            endif;
        elseif  ($filter=='today'):
            $now = \Carbon\Carbon::now();
            $today = $now->format('d-m-Y H:m:s');
            if (Auth::user()->isMedecin()):
                $ordonnances = Ordonnance::where('medecin_id', $id)
                ->whereDate('created_at', $today)->get()->paginate(10);
            elseif (Auth::user()->isPvv()):
                $ordonnances = Ordonnance::where('pvv_id', $id)
                ->whereDate('created_at', $today)->get()->paginate(10);
            elseif (Auth::user()->isPrepose()):
                $ordonnances = Ordonnance::where('prepose_id', $id)
                ->whereDate('created_at', $today)->get()->paginate(10);
            endif;
        else:
            $ordonnances = Ordonnance::All()->paginate(10);
        endif;
        dd($ordonnances);
    }

    public function save(Request $request)
    {
        
        $ord = new Ordonnance();
        $ord->consultation_id = $request['consultation'];
        $ord->pvv_id = $request['pvv'];
        $ord->medecin_id = $request['medecin'];
        if($ord->save){
            $array_produits = json_decode($request['produits']);
            foreach($array_produits as $produit){
                // Get the current time
                $now = Carbon::now();
                // Formulate record that will be saved
                $produits_entries[] = [
                    'ordonnance_id' => $ord->id,
                    'produit_id' => $produit->pid,
                    'quantite' => $produit->qte,
                    'posologie' => $produit->pos,
                    'updated_at' => $now,
                    'created_at' => $now
                ];
                OrdonnanceProduit::insert($produits_entries);
                /*$ordProduit = new OrdonnanceProduit();
                $ordProduit->ordonnance_id = $ord->id;
                $ordProduit->produit_id = $produit->pid;
                $ordProduit->quantite = $produit->qte;
                $ordProduit->posologie =  $produit->pos;
                $ordProduit->save();*/
            }
        }
        else{
            return 'L\'ordonnance n\'a pu être sauvegardée.';
        }
    }
}
