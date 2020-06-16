@extends('base')

@section('main')
<div class="row">
<div class="col-sm-12">
    <h3 class="display-4 feature-title">Nouvelles requ&egrave;tes</h3>   
    @if(session()->has('success'))
      <div class="alert alert-success">{{ session()->get('success') }}</div>
    @endif
    @if(session()->has('error'))
      <div class="alert alert-danger">{{ session()->get('error') }}</div>
    @endif
  <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>Nom</td>
          <td>E-mail</td>
          <td>Compte utilisateur</td>
          <td>Machine</td>
          <td>volume</td>
          <td>Requ&egrave;te</td>
          <td></td>
        </tr>
    </thead>
    <tbody>
        @foreach($tempusers as $user)
          <tr>
              <td>{{$user->id}}</td>
              <td>{{$user->first_name}} {{$user->last_name}}</td>
              <td>{{$user->email}}</td>
              <td>{{$user->username}}</td>
              <td>{{$user->computername}}</td>
              <td>{{$user->volume_label}}</td>
              <td>{{$user->requesttype}}</td>
              <td>
                  <form action="{{ route('approve_register')}}" method="post" class="d-inline-block">
                    @csrf
                    <input type="hidden" name="id" value="{{$user->id}}">
                    <input type="hidden" name="last_name" value="{{$user->last_name}}">
                    <input type="hidden" name="first_name" value="{{$user->first_name}}">
                    <input type="hidden" name="username" value="{{$user->username}}">
                    <input type="hidden" name="password" value="Colas1234">
                    <input type="hidden" name="email" value="{{$user->email}}">
                    <input type="hidden" name="computername" value="{{$user->computername}}">
                    <input type="hidden" name="volume_label" value="{{$user->volume_label}}">
                    <input type="hidden" name="requesttype" value="{{$user->requesttype}}">
                    <input type="hidden" name="active" value="1">
                    <button class="btn btn-sm btn-primary" type="submit" onclick="return confirm('Souhaitez-vous autoriser l\'accès au compte utilisateur {{ $user->username }} ?');">Autoriser</button>
                  </form>
                  <a data-method="DELETE" data-confirm="Souhaitez-vous supprimer cette requête ?" href="{{ route('delete_registration_request',$user->id)}}" class="btn btn-sm btn-danger">{{ __('Supprimer') }}</a>
                  <!--form action="{{ route('delete_registration_request', $user->username)}}" method="post" class="d-inline-block">
                    @csrf
                    <input type="hidden" name="username" value="{{$user->username}}">
                    <button class="btn btn-sm btn-danger" type="submit">Supprimer</button>
                  </form-->
              </td>
              <td>
              </td>
          </tr>
        @endforeach
    </tbody>
  </table>
<div>
</div>
@endsection