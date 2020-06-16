<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\Consultation;
use \App\Models\Diagnostic;
use \App\Models\User;
use \App\Models\Produit;
use \App\Models\LigneProduit;
use Auth;

class ConsultationsController extends Controller
{
    public function index(Request $request, $filter=false)
    {
        //$filter=true;
        if(!$filter){
            if(Auth::user()->isMedecin()){
                $consultations = Consultation::where('medecin_id', Auth::user()->id)->get();//->paginate(10);
            }elseif(Auth::user()->isAgent()){
                $consultations = Consultation::where('agent_id', Auth::user()->id)->get();//->paginate(10);
            }elseif(Auth::user()->isInfirmier()){
                $consultations = Consultation::where('infirmier_id', Auth::user()->id)->get();//->paginate(10);
            }elseif(Auth::user()->isAdmin()){
                $consultations = Consultation::All();//->paginate(10);
            }
        }
        elseif($filter=='today'){
            $now = \Carbon\Carbon::now();
            $today = $now->format('d-m-Y H:m:s');
            $consultations = Consultation::whereDate('created_at', $today)->get();
        }
        elseif($filter=='on_track'){
            $consultations = Consultation::where('closed', '0')->get();
        }
        else{
            $now = \Carbon\Carbon::now();
            $today = $now->format('d-m-Y H:m:s');
            $consultations = Consultation::whereDate('created_at', $today)->get();
        }

        return view('consultations.index', compact('consultations'));
    }

    public function createConsultation($data)
    {
        $consultation = new Consultation();
        $consultation->pvv_id = $data['pvv'];
        $consultation->agent_id = $data['agent'];
        $consultation->medecin_id = $data['medecin'];
        $consultation->save();
    }
    
    public function update(Request $request, int $id)
    {
        $consultation = Consultation::find($id);
        if (isset($request['medecin'])):
            $consultation->medecin_id = $request['medecin'];
            $msg = $consultation->medecin->first_name.' '.$consultation->medecin->last_name;
        elseif (isset($request['infirmier'])):
            $consultation->infirmier_id = $request['infirmier'];
            $msg = $consultation->infirmier->first_name.' '.$consultation->infirmier->last_name;
        endif;
        if ($consultation->save()) {
            return $msg;
        }
        return 'Oups!!! Veuillez réessayer plus tard.';
    }

    public function details(int $id)
    {
        $consultation = Consultation::find($id);
        $agent = User::find($consultation->agent_id);
        $medecins = $this->selectMedecinsByOrganisation($agent->organisation_id, 'ROLE_MEDECIN');
        $infirmiers = $this->selectInfirmiersByOrganisation($agent->organisation_id, 'ROLE_INFIRMIER');
        $produits = Produit::All();
        $ligneproduits = LigneProduit::All();

        return view('consultations.dashboard', compact('consultation', 'infirmiers', 'medecins', 'produits', 'ligneproduits'));
    }

    public function addDiagnostic(Request $request, int $id, int $consultation_id = null)
    {
        if (is_null($consultation_id)):
            $diagnostic = new Diagnostic();
            $diagnostic->consultation_id = $id;
            $diagnostic->content = $request['content'];
            $msg = 'Le diagnostic a été enregistré';
        else:
            $diagnostic = Diagnostic::find($id);
            $diagnostic->content = $request['content'];
            $msg = 'Le diagnostic a été mis à jour';
        endif;
        if ($diagnostic->save()) {
            return $msg;
        }
        return 'Oups!!! Veuillez réessayer plus tard.';
    }
    
        
    /**
    * Get users by organisation and role.
    */
    private function selectInfirmiersByOrganisation($orgId, $role_slug)
    {//dd($role_slug);
        $users = User::select('id','first_name','last_name')
                                        ->where('organisation_id', $orgId)
                                        ->whereHas(
                                                    'roles', function($q){
                                                                $q->where('slug', 'ROLE_INFIRMIER');
                                                            }
                                        )->get();
        return $users;
    }
    
    private function selectMedecinsByOrganisation($orgId)
    {//dd($role_slug);
        $users = User::select('id','first_name','last_name')
                                        ->where('organisation_id', $orgId)
                                        ->whereHas(
                                                    'roles', function($q){
                                                                $q->where('slug', 'ROLE_MEDECIN');
                                                            }
                                        )->get();
        return $users;
    }
}
