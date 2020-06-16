<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Providers\WorkstationServiceProvider as Workstation;
Use Redirect;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Allow username/password Login
    public function username()
    {
        return 'username';
    }

    public function index(Request $request)
    {
        return view('auth.login');
    }

    /**
     * Grant access to users after matching workstation, username and co
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {//dd($request['username']);
        $attributes = [
                        'username' => $request['username'],
                        'password' => $request['password'], //Hash::make($request['password']),
                        'active' => true,
                    ];
//dd($attributes);             
        if (\Auth::attempt($attributes)) {
            return redirect()->intended('delivery-process');
        }
        else{
            session()->flash('error', 'Les informations de connexion sont incorrectes.');
            return redirect()->route('home');
        }
    }
    
    public function processLogin(Request $request)
    {
        $workstationService = new Workstation();
        $workstation = $workstationService->retrieve();

        $win_username = $workstation['window_user'];
        $cp_name = $workstation['computer_name'];
        $svr_name = $workstation['volume_label'];
        $cp_uniq_id = 'UniqueStringGeneratedForThisWorkstation';

        // Check if cookie exist
        $thecookie = $request->cookie('COL_BITUMES_AUTH');
        // Verifies win user existe en bd
        $foundUser = $this->checkWinUser($thecookie);

        if($thecookie==null){
            // 1. Save computer uniq id
            if($foundUser->verified_at==null){
                $now = \Carbon\Carbon::now();
                $foundUser->verified_at = $now->toDateTimeString();
                $foundUser->cp_uniq_id = $cp_uniq_id;
                $foundUser->save();
                // 2. Log user in
                if($foundUser->save()){
                    // Do user login
                    $attributes = [
                                'username' => $foundUser->username,
                                'password' => "Colas1234",
                                'active' => true,
                            ];
                    if (\Auth::attempt($attributes)) {
                        // 3. Set persistent cookie
                        return redirect('delivery-process')->withCookie(cookie()->forever('COL_BITUMES_AUTH', $cp_uniq_id));
                    }
                    session()->flash('error', 'Les informations de connexion sont incorrectes. Contactez votre admin.');
                    return Redirect::back();
                }
            }
            else{
                session()->flash('error', '0Contactez votre admin s\'il vous plaît');
                return Redirect::back();
            }
        }
        //elseif( isset($thecookie) && ($thecookie==$foundUser->cp_uniq_id) ){
        elseif( isset($thecookie) && ($foundUser) ){
            // Match cookie value with value from db
            // Do user login
            $attributes = [
                            'username' => $foundUser->username,
                            'password' => "Colas1234",
                            'active' => true,
                        ];
            if (\Auth::attempt($attributes)) {
                return redirect()->intended('delivery-process');
            }
            else{
                session()->flash('error', 'Les informations de connexion sont incorrectes.');
                return redirect()->route('home');
            }
        }
        else{
            session()->flash('error', '1Contactez votre admin s\'il vous plaît.');
            return Redirect::back();
        }

    }

    private function saveUniqId(\App\User $user)
    {
        $cp_uniq_id = openssl_random_pseudo_bytes(512);
        $user->cp_uniq_id = $cp_uniq_id;
        if($user->save()){
            return true;
        }
        return false;
    }

    /**
     * Verifie si le win user existe en bd.
     *
     * @return \App\User
     */
    public static function checkWinUser($thecookie)
    {
        $validatedUser = \App\User::firstWhere('cp_uniq_id', $thecookie);
        return ($validatedUser!=null) ? $validatedUser : false;
    }

    private function setCookie($cp_uniq_id)
    {
        //Create a response instance
        $response = new \Illuminate\Http\Response('Cookie cree!');

        //Call the withCookie() method with the response method
        $response->withCookie(cookie('COL_BITUMES_AUTH', $cp_uniq_id, 10));
        //$response->withCookie(cookie()->forever('name', 'value'));
        dd($response);
        //return the response
        return $response;
    }
}
