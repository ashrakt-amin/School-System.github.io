<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Traits\AuthTrait;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    use AuthTrait ,  AuthenticatesUsers;
    
    //  protected $redirectTo = RouteServiceProvider::HOME;


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('guest:student')->except('logout');
        $this->middleware('guest:teacher')->except('logout');
        $this->middleware('guest:parent')->except('logout');



    }


    public function loginForm($type)
    {
        return view('auth.login', compact('type'));
    }


    public function login(Request $request)
    {

        $guard = $request->type;
       // return $request;


        if (Auth::guard($guard)->attempt(
            ['email'=> $request->email,'password' => $request->password]
        )) {
            if ($guard == 'parent') {
                 return redirect()->intended(RouteServiceProvider::Parent);
            } elseif ($guard == "student") {
                 return redirect()->intended(RouteServiceProvider::Student);
            } elseif ($guard == 'teacher') {
                return redirect()->intended(RouteServiceProvider::Teacher);
            } else{
                return redirect()->intended(RouteServiceProvider::HOME);
            }
        }else{
            return "null";
        }
    }


    public function logout(Request $request, $type)
    {
        Auth::guard($type)->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
