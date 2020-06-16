@extends('listviews_top')

@section('list_title')
    Tous les utilisateurs
@endsection

@section('top_table_menu')
    <div class="col-sm-4 mb-2">
      <a id="add_user" data-method="POST" href="{{ route('register') }}" class="btn btn-success text-white">Nouvel utilisateur</a>
    </div>
@endsection

@section('search_btn_id')
    id="search_users" data-href="{{ url('/users/search/') }}"
@endsection

@section('list_table')

  <table class="table table-striped">
    <thead>
        <tr>            
          <td>Nom</td>
          <td>E-mail</td>
          <td>Compte utilisateur</td>
          <td>Machine</td>
          <td>Volume</td>
          <td>Roles</td>
          <td colspan = 3></td>
        </tr>
    </thead>
    <tbody>
        @foreach($users as $user)
          <tr>
              <td>{{$user->first_name}} {{$user->last_name}}</td>
              <td>{{$user->email}}</td>
              <td>{{$user->username}}</td>
              <td>
                @isset($user->pvv_data->codepvv)
                  {{$user->pvv_data->codepvv}}
                @endisset
              </td>
              <td>{{$user->volume_label}}</td>
              <td>
                @if (count($user->roles()->get()) > 0)
                  @foreach($user->roles()->get() as $role)
                    {{$role->name}}
                  @endforeach
                @endif
              </td>
              <td>
              </td>
              <td><span class="glyphicon glyphicon-remove"></span>
                  <a href="{{ route('users.edit',$user->id)}}" class="btn btn-sm btn-primary">{{ __('Modifier') }}</a>
                  @if($user->active==0)
                    <a data-method="PUT" data-confirm="Souhaitez-vous activer ce compte ?" href="{{ route('user.toggle.access',[$user->id,1])}}" class="btn btn-sm btn-light">{{ __('Activer') }}</a>
                  @else
                    <a data-method="PUT" data-confirm="Souhaitez-vous suspendre ce compte ?" href="{{ route('user.toggle.access',[$user->id,0])}}" class="btn btn-sm btn-primary">{{ __('Suspendre') }}</a>
                  @endif
                  @if($user->verified_at==null)
                    <a class="btn btn-sm btn-light disabled">{{ __('Réinitialiser') }}</a>
                  @else
                    <a data-method="PUT" data-confirm="Souhaitez-vous réinitialiser ce compte ?" href="{{ route('user.reset',$user->id)}}" class="btn btn-sm btn-primary">{{ __('Réinitialiser') }}</a>
                  @endif
                  <a data-method="DELETE" data-confirm="Souhaitez-vous supprimer ce compte ?" href="{{ route('user.destroy',$user->id)}}" class="btn btn-sm btn-danger">{{ __('Supprimer') }}</a>
                  <!--form action="{{ route('user.destroy', $user->id)}}" method="post">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" type="submit">Supprimer</button>
                  </form-->
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