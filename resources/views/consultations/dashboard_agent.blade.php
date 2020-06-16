@extends('base')

@section('main')
<style>
    textarea{
        background-image: url('/Laravel/sync/v3.landela/public/img/fond_bloc_notes.jpg');
        background-repeat: no-repeat;
        background-position: top;
        background-attachment: scroll;
    }
</style>
<div class="row">
<div class="col-sm-12">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h4 class="feature-title">Consultation N° -----HK2004-29001</h4>             
        </div>
        <div class="col-sm-6"> 
            <div class="btn-group float-right" role="group" aria-label="medecinMenu">
                <button class="btn btn-primary" type="button">Diagnostic</button>
                <button class="btn btn-primary" type="button">Ordonnances</button>
                <button class="btn btn-primary" type="button">Examens</button>
                <button class="btn btn-primary" type="button">Rédiger un avis</button>
            </div>            
        </div>
    </div>
    @if(session()->has('success'))
      <div class="alert alert-success">{{ session()->get('success') }}</div>
    @endif
    @if(session()->has('error'))
      <div class="alert alert-danger">{{ session()->get('error') }}</div>
    @endif


    <div class="row">
        <div class="col-sm-3 border border-primary pt-2 mb-2">
            <div class="cons p-2 mb-2 bg-warning">
                <h6><b>Receptionniste</b>: {{ $consultation->agent->first_name }} {{ $consultation->agent->last_name }}</h6>
                <h6><b>Infirmier</b>: Nom Infirmier</h6>
                <h6><b>Médecin</b>: Nom médecin</h6>
                <h6><b>Etat</b>: Ouverte</h6>
            </div>
            <div class="cons p-2 mb-2 bg-info">
                <h5 class="font-weight-bold p-2 border border-bottom-2">Informations sur le PVV</h5>
                <h6><b>Nom</b>: {{ $consultation->pvv->first_name }} {{ $consultation->pvv->last_name }}</h6>
                <h6><b>Age</b>: {{ $consultation->pvv->birthdate }}</h6>
                <h6><b>E-mail</b>: {{ $consultation->pvv->email }}</h6>
            <a class="btn btn-sm btn-primary" href="{{ url('/users/'.$consultation->pvv->id.'/edit') }}">Voir la fiche complète</a>
            </div>
        </div>
        <div class="col-sm-5 border border-primary mb-2">
            <div class="diagnostic">
                <h5 class="font-weight-bold p-2 border border-bottom-2">Attribuer un médecin</h5>
                <div class="form-group">
                    <label for="medecin">Text</label>
                    <select id="medecin" class="form-control" name="">
                        <option>Text</option>
                    </select>
                </div>
            </div>
            <div class="diagnostic">
                <h5 class="font-weight-bold p-2 border border-bottom-2">Attribuer un infirmier</h5>
                <div class="form-group">
                    <label for="medecin">Text</label>
                    <select id="medecin" class="form-control" name="">
                        <option>Text</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
  
<div>
</div>
@endsection