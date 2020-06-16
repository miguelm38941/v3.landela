@extends('base') 
@section('main')
<div class="row">
    <div class="col-sm-8 offset-sm-2">
        <h4 class="display-4 feature-title">Mise à jour du compte {{ $user->username }}</h4>

        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        <br /> 
        @endif
        <form method="post" action="{{ route('users.update', $user->id) }}">
            @method('PATCH') 
            @csrf
            <div class="form-group row">
                <label for="" class="col-md-4 col-form-label text-md-right">{{ __('Roles') }}</label>
                <div class="col-md-6">
                    @foreach ($roles as $role)
                        <div class="form-check form-check-inline">
                            <input id="my-input" class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->id }}">
                            <label for="my-input" class="form-check-label">{{ $role->name }}</label>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="form-group row">
                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                <div class="col-md-6">
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $user->email }}" required autocomplete="email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('Prénom') }}</label>

                <div class="col-md-6">
                    <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ $user->first_name }}" required autocomplete="first_name">

                    @error('first_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="last_name" class="col-md-4 col-form-label text-md-right">{{ __('Nom') }}</label>

                <div class="col-md-6">
                    <input id="last_name" type="last_name" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ $user->last_name }}" required autocomplete="last_name">

                    @error('last_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Nom d\'utilisateur') }}</label>

                <div class="col-md-6">
                    <input id="username" type="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ $user->username }}" required autocomplete="username">

                    @error('username')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="computername" class="col-md-4 col-form-label text-md-right">{{ __('Nom du PC') }}</label>

                <div class="col-md-6">
                    <input id="computername" type="computername" class="form-control @error('computername') is-invalid @enderror" name="computername" value="{{ $user->computername }}" required autocomplete="computername">

                    @error('computername')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="volume_label" class="col-md-4 col-form-label text-md-right">{{ __('N° Série HDD') }}</label>

                <div class="col-md-6">
                    <input id="volume_label" type="volume_label" class="form-control @error('volume_label') is-invalid @enderror" name="volume_label" value="{{ $user->volume_label }}" required autocomplete="volume_label">

                    @error('volume_label')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <a href="{{ url()->previous() }}" class="btn btn-danger">Back</a> 
            <button type="submit" class="btn btn-primary">Modifier</button>
        </form>
    </div>
</div>
@endsection