@extends('base')

@section('main')
<div class="row">
<div class="col-sm-12">
    <h3 class="display-4 feature-title">Tous les consultations</h3>  
    @if(session()->has('success'))
      <div class="alert alert-success">{{ session()->get('success') }}</div>
    @endif
    @if(session()->has('error'))
      <div class="alert alert-danger">{{ session()->get('error') }}</div>
    @endif

  <table class="table table-striped">
    <thead>
        <tr style="font-weight:bold">
          <td>Code PVV</td>
          <td>Médecin</td>
          <td>Réceptionniste</td>
          <td>Infirmier</td>
          <td>Date</td>
          <td>Etat</td>
          <td></td>
        </tr>
    </thead>
    <tbody>
        @forelse($consultations as $consultation)
          <tr>
              <td>{{$consultation->pvv->first_name}} {{$consultation->pvv->last_name}}</td>
              <td>
                @isset($consultation->medecin)
                  Dr {{$consultation->medecin->first_name}} {{$consultation->medecin->last_name}}
                @else
                  N/A
                @endisset
              </td>
              <td>{{$consultation->agent->first_name}} {{$consultation->agent->last_name}}</td>
              <td>
                @isset($consultation->infirmier)
                {{$consultation->infirmier->first_name}} {{$consultation->infirmier->last_name}}
                @else
                  N/A
                @endisset
              </td>
              <td>{{$consultation->created_at}}</td>
              <td>{{$consultation->closed}}</td>
              <td><span class="glyphicon glyphicon-remove"></span>
                  <a href="{{ url('pvv/consultations/dashboard/'.$consultation->id)}}" class="btn btn-sm btn-primary">{{ __('Voir') }}</a>                  
                  <a data-method="DELETE" data-confirm="Souhaitez-vous supprimer cette consultation ?" href="{{ route('user.destroy',$consultation->id)}}" class="btn btn-sm btn-danger">{{ __('Supprimer') }}</a>
                  <!--form action="{{ route('user.destroy', $consultation->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" type="submit">Supprimer</button>
                  </form-->
              </td>
          </tr>
        @empty
          <tr>
            <td colspan="7"> Aucune consultation trouvée.</td>
          </tr> 
        @endforelse
    </tbody>
    <tfooter>
        <tr>
          <td colspan = 9> &nbsp; </td>
        </tr>
        <tr>
          <td colspan = 9> 
            @empty($consultations)
              {{-- $consultations->links() --}}
            @endisset 
          </td>
        </tr>
    </tfooter>
  </table>
  
<div>
</div>
@endsection