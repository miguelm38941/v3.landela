<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Colas Bitumes</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="{{ asset('js/larawiggy.js') }}"></script>
</head>
<body>
<div class="container">
<div class="row">
 <div class="col-sm-8 offset-sm-2">
    <h3 class="display-4 feature-title">Nouvelle inscription</h3>
  <div>
    @if(session()->has('success'))
      <div class="alert alert-success">{{ session()->get('success') }}</div>
    @endif
    @if(session()->has('error'))
      <div class="alert alert-danger">{{ session()->get('error') }}</div>
    @endif
    @if ($errors->any())
      <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
              <li>{{ $error }}</li>
            @endforeach
        </ul>
      </div><br />
    @endif
      <form method="post" action="{{ route('self_register') }}">
          @csrf
        <div class="form-group">    
            <label for="username">Nom d'utilisateur:</label>
            <input id="username" type="text" class="form-control" name="username"/>
        </div>

        <div class="form-group">    
              <label for="name">Nom:</label>
              <input type="text" class="form-control" name="nom"/>
          </div>

          <div class="form-group">
              <label for="adress">Pr&eacute;nom:</label>
              <input type="text" class="form-control" name="prenom"/>
          </div>

          <div class="form-group">
              <label for="adress">E-mail:</label>
              <input type="email" class="form-control" name="email"/>
          </div>
          <input type="hidden" class="form-control" name="requesttype" value="{{ $requesttype }}"/>

          <a class="btn btn-link" href="{{ route('home') }}">Annuler</a>
          <button type="submit" class="btn btn-primary">Soumettre</button>
      </form>
  </div>
</div>
</div>
</div>
</body>
</html>