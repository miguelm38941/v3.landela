<!DOCTYPE html>
<html lang="en">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}" />
  <link rel="icon" type="image/png" href="{{ asset('img/logo_landela.jpg') }}" />
  <title>Landela v3</title>
  <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  
  <!-- Bootstrap Date-Picker Plugin -->
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
  <script src="{{ asset('js/consultations.js') }}"></script>
  <script src="{{ asset('js/searchjs.js') }}"></script>
</head>
<body>
  @include('sweetalert::alert')
    <header>
        <!-- Fixed navbar -->
        <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-primary">
          <img src="{{ asset('img/logo_landela.jpg') }}" alt="Landela" style="max-width: 50px; margin-right: 30px;">
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mr-auto">
              <li class="nav-item {{(strpos(url()->current(),'delivery-process') !== false)?'active':''}}" id="deliveryProcess">
                <a class="nav-link" href="{{ route('pvv.list') }}">PVVs <span class="sr-only">(current)</span></a>
              </li>
              <li class="nav-item 
                @if( (strpos(url()->current(),'consultations_list_filter') !== false) ||
                      (strpos(url()->current(),'consultations_list') !== false) )
                  {{'active'}}
                @endif
                dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                  Consultations
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                  <a class="dropdown-item" href="{{ route('consultations_list_filter', 'today') }}">Aujourd'hui</a>                  
                  <a class="dropdown-item" href="{{ route('consultations_list_filter', 'on_track') }}">Non terminées</a>                  
                  <a class="dropdown-item" href="{{ route('consultations_list') }}">Toutes</a>
                </div>
              </li>
            </ul>

            <div class="form-inline mt-2 mt-md-0 loggedin-user">
                <h6 class="pr-2">Bienvenu(e)
                  @auth
                    <span>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</span> 
                  @endauth

                  @guest
                      {{ 'Local User' }}
                  @endguest                
                </h6>
                  @guest
                     | <a class="text-light" href="{{ route('login') }}">Administrateur</a>
                  @else
                    @if (Auth::user()->isAdmin())
                      <ul class="navbar-nav mr-auto">
                        <li class="nav-item dropdown active btn-sm">
                          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Administration
                          </a>
                          <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a class="dropdown-item btn btn-sm btn-warning" href="{{ route('users.list')}}">
                              Utilisateurs
                            </a>
                            <a class="dropdown-item btn btn-sm btn-warning" href="{{ route('registration_requests')}}">
                              Nouvelles inscriptions
                            </a>
                            <a class="dropdown-item btn btn-sm btn-warning" href="{{ route('register') }}">
                              Nouvel utilisateur 
                            </a>
                          </div>
                        </li>
                      </ul>
                    @endif





                    <a class="btn btn-sm btn-warning" href="{{ route('logout') }}"
                      onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        {{ __('Déconnexion') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                      @csrf
                    </form>
                  @endguest
                

              </div>
          </div>

        </nav>
    </header>
    <main>
        <div class="container">
          <div class="row">
            <div class="col-sm-2 bg-primary text-white pt-2">
              <h4 class="border border-white border-bottom-1 p-2 font-weight-bold">{{ Auth::user()->organisation->nom }}</h4>
              <hr>
              <h5 class="border border-white border-bottom-1 p-2 mt-3">
                <i>{{ Auth::user()->first_name }} {{ Auth::user()->last_name }}</i>
                <div><i>Vous êtes connecté!</i></div>
              </h5>
            </div>
            <div class="col-sm-10">
              @yield('main')
            </div>
          </div>
        </div>
    </main>
  <script src="{{ asset('js/app.js') }}" type="text/js"></script>
  <script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Add active class to the current button (highlight it)
    $(document).ready(function() {
      $.each($('#navbar').find('li'), function() {
          $(this).toggleClass('active', 
              window.location.pathname.indexOf($(this).find('a').attr('href')) > -1);
      }); 
    });
  </script>
</body>
</html>