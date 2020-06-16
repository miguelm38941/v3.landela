@extends('listviews_top')

@section('top_table_menu')
    <div class="col-sm-4 mb-2">
        <a id="add_exams" data-method="POST" href="{{ route('register') }}" class="btn btn-success text-white">Prescrire de nouveaux examens</a>
    </div>
@endsection

@section('list_table')

  <table class="table table-striped">
    <thead>
        <tr>
          <td>Date</td>
          <td>Consultation</td>
          <td>PVV</td>
          <td>Médecin</td>
          <td>Intitulé examen</td>
          <td>Résultats</td>
          <td></td>
        </tr>
    </thead>
    <tbody>
        @foreach($examens as $examen)
          <tr>
              <td>{{$examen->created_at}}</td>
              <td>{{$examen->consultation_id}}</td>
              <td>{{$examen->pvv_id}}</td>
              <td>{{$examen->medecin_id}}</td>
              <td>{{$examen->examen_slug}}</td>
              <td>{{$examen->resultats}}</td>
              <td><span class="glyphicon glyphicon-remove"></span>
                <button class="btn btn-sm btn-primary" type="button">Résultats</button>
              </td>
          </tr>
        @endforeach
    </tbody>
    <tfooter>
        <tr>
          <td colspan = 7> &nbsp; </td>
        </tr>
        <tr>
          <td colspan = 7> {{ $examens->links() }} </td>
        </tr>
    </tfooter>
  </table>

@endsection