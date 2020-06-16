@extends('listviews_top')

@section('list_title')
    Tous les PVV
@endsection

@section('top_table_menu')
    <div class="col-sm-4 mb-2">
      <a id="add_user" data-method="POST" href="{{ route('register') }}" class="btn btn-success text-white">Enregistrer un PVV</a>
    </div>
@endsection

@section('search_btn_id')
    id="search_users" data-href="{{ url('/pvvs/search/') }}"
@endsection

@section('list_table')

  <table class="table table-striped">
    <thead>
        <tr>            
          <td>Code PVV</td>
          <td>Nom</td>
          <td>E-mail</td>
          <td>Compte utilisateur</td>
          <td>Zone de santé</td>
          <td>Région sanitaire</td>
          <td colspan = 3></td>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
          <tr>
              <td>
                @isset($user->pvv_data->codepvv)
                  {{$user->pvv_data->codepvv}}
                @endisset
              </td>
              <td>{{$user->first_name}} {{$user->last_name}}</td>
              <td>{{$user->email}}</td>
              <td>{{$user->username}}</td>
              <td>
                @isset($user->zone_sante->nom)
                  {{$user->zone_sante->nom}}
                @endisset
              </td>
              <td>
                @isset($user->region_sante->nom)
                  {{$user->region_sante->nom}}
                @endisset
              </td>
              <td>
              </td>
              <td><span class="glyphicon glyphicon-remove"></span>
                  <a href="{{ route('users.edit',$user->id)}}" class="btn btn-sm btn-primary">{{ __('Modifier') }}</a>
              </td>
          </tr>
        @endforeach
    </tbody>
    <tfooter>
        <tr>
          <td colspan = 9> &nbsp; </td>
        </tr>
        <tr>
          <td colspan = 9> {{ $users->links() }} </td>
        </tr>
    </tfooter>
  </table>

@endsection