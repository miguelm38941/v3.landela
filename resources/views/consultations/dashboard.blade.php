@extends('consultations.base_cons')

@section('cons_menu')
<div class="col-sm-6"> 
    <div class="btn-group float-right" role="group" aria-label="medecinMenu">
        <button class="btn btn-primary" type="button">Diagnostic</button>
        <button class="btn btn-primary" type="button">Ordonnances</button>
        <a class="btn btn-primary text-white" href="{{ route('medecin.mesexamens', $consultation->medecin->id) }}">Examens</a>
        <button class="btn btn-danger font-weight-bolder" type="button">Terminer cette consultation</button>
    </div>            
</div>
@endsection

@if (Auth::user()->isAgent())
    
@section('section_agent')
<div class="col-sm-5 border border-primary pt-2 mb-2">
    <div id="update_infirmier_div" class="border border-1 p-2">
        <h5 class="font-weight-bold p-2 border-bottom-2">Attribuer un infirmier à cette consultation</h5>
        <div class="form-group">
            <select id="infirmier" class="form-control" name="infirmier">
                <option>Sélectionner un infirmier</option>
                @foreach ($infirmiers as $item)
                    <option value="{{ $item->id }}"
                        @if ($item->id===$consultation->infirmier_id) selected @endif>{{ $item->first_name }} {{ $item->last_name }}</option>
                @endforeach
            </select>
            <button id="update_infirmier" class="btn btn-primary" data-id="{{ $consultation->id }}" data-method="POST" data-href="{{ route('consultation.update.infirmier', $consultation->id)}}" type="button">Attribuer</button>
        </div>
    </div>
    <div id="update_medecin_div" class="border border-1 p-2 mt-2">
        <h5 class="font-weight-bold p-2 border-bottom-2">Attribuer un médecin à cette consultation</h5>
        <div class="form-group">
            <select id="medecin" class="form-control" name="medecin">
                <option>Sélectionner un médecin</option>
                @foreach ($medecins as $item)
                    <option value="{{ $item->id }}"
                        @if ($item->id===$consultation->medecin_id) selected @endif>{{ $item->first_name }} {{ $item->last_name }}</option>
                @endforeach
            </select>
            <button id="update_medecin" class="btn btn-primary" data-id="{{ $consultation->id }}" data-method="POST" data-href="{{ route('consultation.update.medecin', $consultation->id)}}" type="button">Attribuer</button>
        </div>
    </div>
</div>
@endsection
@endif


@if (Auth::user()->isMedecin())
@section('section_medecin')
<style>
    textarea{
        background-image: url('/Laravel/sync/v3.landela/public/img/fond_bloc_notes.jpg');
        background-repeat: repeat-y;
        background-position: top;
        background-attachment: scroll;
        line-height: 18px;
    }
</style>            
        <div class="col-sm-4 pl-0 mb-2">
            <div style="padding: 5px; background-color:#0e71c2; border-radius:8px">
                <div id="diagnostic">
                    <h5 class="font-weight-bold p-2">Diagnostic</h5>
                    <div class="diagnostic p-2">
                        <div class="form-group">
                            <textarea id="diagnostic_content" class="form-control" name="diagnostic" rows="5">@isset($consultation->diagnostic){{ $consultation->diagnostic->content }}@endisset</textarea>
                        </div>
                        @isset($consultation->diagnostic)
                            <button id="add_diagnostic" class="btn btn-sm btn-primary" data-id="{{ $consultation->diagnostic->id }}" data-method="POST" data-href="{{ route('diagnostic.edit', [$consultation->id, $consultation->diagnostic->id]) }}" type="button">Mettre à jour</button>
                        @else
                            <button id="add_diagnostic" class="btn btn-sm btn-primary" data-id="" data-method="POST" data-href="{{ route('diagnostic.add', $consultation->id) }}" type="button">Enregistrer</button>
                        @endisset
                    </div>
                </div>                
            </div>
        </div>
        <div class="col-sm-5 pt-2 pb-4" style="background: #f0f0b8; border-radius:8px">
            <div id="ordonnance">
                <h5 class="font-weight-bold p-2">Rédiger une ordonnance</h5>
                <div class="form-ordonnance">
                    <div class="border border-2 p-2">
                        <h6>Ajouter un produit</h6>
                        <div class="row">
                            <div class="col-sm-5 p-1 pl-4">
                                <select id="produit" class="form-control" name="produit">
                                    <option>Produit</option>
                                    @foreach ($produits as $produit)
                                        <option value="{{ $produit->id }}">{{ $produit->nom }} - {{ $produit->forme }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-sm-2 p-1">
                                <input id="quantite" class="form-control" type="text" name="quantité" placeholder="Quantité">
                            </div>
                            <div class="col-sm-3 p-1">
                                <input id="posologie" class="form-control" type="text" name="posologie" placeholder="Posologie">
                            </div>
                            <div class="col-sm-2 p-1">
                                <button id="ord_add_product" class="btn btn-success" data-cons="{{ $consultation->id }}" data-pvv="{{ $consultation->pvv->id }}" data-medecin="{{ $consultation->medecin->id }}" data-href="" data-method="POST">Ok</button>
                            </div>
                        </div>
                    </div>
                    
                    <div class="p-2 mt-2">
                        <h6>Ajouter une ligne de produits</h6>
                        <div class="row">
                            <div class="col-sm-10 p-1 pl-4">
                                <select id="produit" class="form-control" name="produit">
                                    <option>Ligne de Produits</option>
                                    <option>Text 1</option>
                                    <option>Text 2</option>
                                </select>
                            </div>
                            <div class="col-sm-2 p-1">
                                <button class="btn btn-success" data-href="" data-method="POST">Ok</button>
                            </div>
                        </div>
                    </div>
                    <div class="p-2 mt-2">
                        <button id="save_ordonnance" class="btn btn-primary" data-produits="" data-cons="{{ $consultation->id }}" data-pvv="{{ $consultation->pvv->id }}" data-medecin="{{ $consultation->medecin->id }}" data-href="{{ route('ordonnance.save', $consultation->id) }}" data-method="POST" type="button">Enregistrer l'ordonnance</button>
                    </div>
                </div>
                <div id="ord_content" class="row ml-1 mr-1" style="background: #fff;margin-top:10px">
                    <div id="produits_list" class="col-12 border border-2 rounded p-2">
                        <div class="row pt-2 pb-2 font-weight-bold" style="background: #ccc">
                            <div class="col-sm-6">Médicament</div>
                            <div class="col-sm-2">Qté</div>
                            <div class="col-sm-4">Posologie</div>
                        </div>
                        <div class="row pl-2 pr-2">
                            <div class="col-sm-6 pt-1 pb-1" style="border-bottom:1px dashed #ccc;">Médicament</div>
                            <div class="col-sm-2 pt-1 pb-1" style="border-bottom:1px dashed #ccc;">Qté</div>
                            <div class="col-sm-4 pt-1 pb-1" style="border-bottom:1px dashed #ccc;">Posologie</div>
                        </div>
                        <div class="row pl-2 pr-2">
                            <div class="col-sm-6 pt-1 pb-1" style="border-bottom:1px dashed #ccc;">Médicament</div>
                            <div class="col-sm-2 pt-1 pb-1" style="border-bottom:1px dashed #ccc;">Qté</div>
                            <div class="col-sm-4 pt-1 pb-1" style="border-bottom:1px dashed #ccc;">Posologie</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            
@endsection
@endif
