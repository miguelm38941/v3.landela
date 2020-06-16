@extends('base')

@section('main')
<div>
<div class="row">
<div class="col-sm-8">
    <h3 class="display-4 feature-title">Nouvel utilisateur</h3>
    <div>

                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!--div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div-->
                        <div class="form-group row">
                            <label for="" class="col-md-4 col-form-label text-md-right">{{ __('Roles') }}</label>
                            <div class="col-md-8">
                                @foreach ($roles as $role)
                                    <div class="form-check form-check-inline">
                                        <input id="my-input" class="form-check-input" type="checkbox" name="roles[]" value="{{ $role->id }}">
                                        <label for="my-input" class="form-check-label">{{ $role->name }}</label>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right">{{ __('Prénom') }}</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control @error('first_name') is-invalid @enderror" name="first_name" value="{{ old('first_name') }}" required autocomplete="first_name">

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
                                <input id="last_name" type="last_name" class="form-control @error('last_name') is-invalid @enderror" name="last_name" value="{{ old('last_name') }}" required autocomplete="last_name">

                                @error('last_name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Téléphone') }}</label>
                            <div class="col-md-6">
                                <input id="phone" type="date_naissance" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">
                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="date_naissance" class="col-md-4 col-form-label text-md-right">{{ __('Date de naissance') }}</label>
                            <div class="col-md-6">
                                <input id="date_naissance" type="date_naissance" class="form-control @error('date_naissance') is-invalid @enderror" name="date_naissance" value="{{ old('date_naissance') }}" required autocomplete="date_naissance">
                                @error('date_naissance')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="etat_civil" class="col-md-4 col-form-label text-md-right">Etat civil</label></label>
                            <div class="col-md-6">
                                <select id="etat_civil" class="form-control" name="etat_civil">
                                    <option value="">Sélectionner</option>
                                    <option value="Célibataire">Célibataire</option>
                                    <option value="Marié">Marié</option>
                                    <option value="Divocé">Divocé</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="sexe" class="col-md-4 col-form-label text-md-right">Sexe</label></label>
                            <div class="col-md-6">
                                <select id="sexe" class="form-control" name="sexe">
                                    <option value="">Sélectionner</option>
                                    <option value="Masculin">Masculin</option>
                                    <option value="Féminin">Féminin</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="username" class="col-md-4 col-form-label text-md-right">{{ __('Nom d\'utilisateur') }}</label>

                            <div class="col-md-6">
                                <input id="username" type="username" class="form-control @error('username') is-invalid @enderror" name="username" value="{{ old('username') }}" required autocomplete="username">

                                @error('username')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Mot de passe') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirmer le mot de passe') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="ville" class="col-md-4 col-form-label text-md-right">Ville</label></label>
                            <div class="col-md-6">
                                <select id="ville" class="form-control" name="ville">
                                    <option value="">Sélectionner</option>
                                    @foreach($villes as $ville)
                                        <option value="{{ $ville->id }}">{{ $ville->nom }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="province" class="col-md-4 col-form-label text-md-right">Province</label></label>

                            <div class="col-md-6">
                            <select id="province" class="form-control" name="province">
                                <option>Sélectionner</option>
                                @foreach($provinces as $province)
                                    <option value="{{ $province->id }}">{{ $province->nom }}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="zonesante" class="col-md-4 col-form-label text-md-right">Zone de santé</label></label>

                            <div class="col-md-6">
                            <select id="zonesante" class="form-control" name="zonesante">
                                <option>Sélectionner</option>
                                @foreach($zones as $zone)
                                    <option value="{{ $zone->id }}">{{ $zone->nom }}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="regionsante" class="col-md-4 col-form-label text-md-right">Région sanitaire</label></label>

                            <div class="col-md-6">
                            <select id="regionsante" class="form-control" name="regionsante">
                                <option>Sélectionner</option>
                                @foreach($regions as $region)
                                    <option value="{{ $region->id }}">{{ $region->nom }}</option>
                                @endforeach
                            </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="formationsanitaire" class="col-md-4 col-form-label text-md-right">Formation sanitaire</label></label>

                            <div class="col-md-6">
                            <select id="formationsanitaire" class="form-control" name="formationsanitaire">
                                <option value="1">Kalembelembe</option>
                            </select>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Sauvegarder') }}
                                </button>
                            </div>
                        </div>
                    </form>

    </div>
</div>
</div>
@endsection
