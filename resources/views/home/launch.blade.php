<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Colas Bitumes</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-12 justify-content-center">
            <h3 class="display-4 feature-title">COLAS BITUMES</h3>   
            <h3 class="text-center">        
                Bienvenue
            </h3>
            <div class="row justify-content-center">
                @if(session()->has('success'))
                <div class="alert alert-success">{{ session()->get('success') }}</div>
                @endif
                @if(session()->has('error'))
                <div class="alert alert-danger">{{ session()->get('error') }}</div>
                @endif
            </div>
            <div class="row justify-content-center">
                <div class="col-sm-4 text-center justify-content-center">
                    @if($check['can_login']==1)
                        <!--a href="{{ route('login')}}" class="btn  btn-primary align-self-center" type="button">Connexion</a-->
                        <form action="{{ route('home.login', 'Wiggy')}}" method="post" class="col-sm-4 justify-content-center m-sm-auto">
                            @csrf
                            <input type="hidden" name="username" value="{#{$winUser->username}#}">
                            <input type="hidden" name="password" value="Colas1234">
                            <button class="btn btn-sm btn-primary" type="submit">Connexion</button>
                        </form>
                        &nbsp;
                    @endif
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-sm-4 text-center">
                    @if($check['new_user']==1)
                        <a href="{{ route('self_register_form', ['requesttype'=>'requestNewRegistration'])}}" class="btn btn-sm btn-primary align-self-center" type="button">Demander un acc&egrave;s</a>
                        &nbsp;
                    @endif
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-sm-4 text-center">
                    @if($check['new_pc']==1)
                        <a href="{{ route('self_register_form', ['requesttype'=>'addNewWorkstation'])}}" class="btn btn-primary align-self-center" type="button">Nouveau poste de travail</a>
                        &nbsp;
                    @endif
                </div>
            </div>
        </div>
        <a href="{{ route('login') }}" class="align-self-center mt-5">Administrateur</a>
    </div>
</div>
</body>
</html>