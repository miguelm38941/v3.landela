@extends('base')

@section('main')

<div class="row">
<div class="col-sm-12">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h4 class="feature-title">Consultation N° -----HK2004-29001</h4>             
        </div>
        @yield('cons_menu')
    </div>
    @if(session()->has('success'))
      <div class="alert alert-success">{{ session()->get('success') }}</div>
    @endif
    @if(session()->has('error'))
      <div class="alert alert-danger">{{ session()->get('error') }}</div>
    @endif


    <div class="row">
        <div class="col-sm-3 bgd-white pt-2 mb-2">
            <div class="cons p-2 mb-2 bg-warning">
                <h6><b>Receptionniste</b>: {{ $consultation->agent->first_name }} {{ $consultation->agent->last_name }}</h6>
                <h6><b>Infirmier</b>: 
                    <span class="infirmier">
                        @isset($consultation->pvv->first_name)
                            {{ $consultation->infirmier->first_name }} {{ $consultation->infirmier->last_name }}
                        @else
                           N/A 
                        @endif
                    </span>
                </h6>
                <h6><b>Médecin</b>: 
                    <span class="medecin">
                        @isset($consultation->medecin->first_name)
                            {{ $consultation->medecin->first_name }} {{ $consultation->medecin->last_name }}
                        @else
                           N/A 
                        @endif
                    </span>
                </h6>
                <h6><b>Etat</b>: 
                    @if(null==$consultation->etat)
                        EN COURS
                    @else
                        TERMINE
                    @endif
                </h6>
            </div>
            <div class="cons p-2 mb-2 bg-info">
                <h5 class="font-weight-bold p-2 border border-bottom-2">Informations sur le PVV</h5>
                <h6><b>Code PVV</b>: {{ $consultation->pvv->first_name }} {{ $consultation->pvv->last_name }}</h6>
                @if(Auth::user()->isMedecin())
                    <h6><b>Nom</b>: {{ $consultation->pvv->first_name }} {{ $consultation->pvv->last_name }}</h6>
                @endif
                <h6><b>Age</b>: {{ $consultation->pvv->birthdate }}</h6>
                @if(Auth::user()->isMedecin())
                    <h6><b>E-mail</b>: {{ $consultation->pvv->email }}</h6>
                @endif
                <a class="btn btn-sm btn-primary" href="{{ url('/users/edit', $consultation->pvv->id) }}">Voir la fiche complète</a>
            </div>
        </div>
        @yield('section_agent')
        @yield('section_medecin')
        </div>
    </div>
  
<div>
</div>
@endsection