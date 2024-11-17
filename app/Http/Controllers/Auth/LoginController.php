<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    // protected $redirectTo = '/home';
    function redirectTo(){
        if(Auth::user()->role == '1'){
            return route('index.dashboard');
        }elseif(Auth::user()->role == '2'){
            return route('index.home');
        }

        return '/login';
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }

    protected function validateLogin(Request $request){
        $message = [
            'email.required' => 'masukan email anda',
            'password.required' => 'masukan password anda',
        ];

        $request->validate([
            // $this->nim() => 'required',
            'email' => 'required|email',
            'password' => 'required',
        ], $message);
    }
}
