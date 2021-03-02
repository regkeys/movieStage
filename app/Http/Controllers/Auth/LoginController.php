<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
// included below for users to bring in
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
     *     - I commented out original line below because we replaced it with the redirect function below
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::DASHBOARD;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }



    /**
     * New redirect to anyplace we tell it for different Users - ie. admin
     * bring in Auth Facade up above
     *
     * @var string
     */
    public function redirectTo(){
        if (Auth::user()->hasAnyRoles(['admin', 'viewOnlyAdmin'])){
            $this->redirectTo = route('admin.users.index');
            return $this->redirectTo;
        }

        // if not admin them send all else to dashboard page
        $this->redirectTo = RouteServiceProvider::DASHBOARD;
        return $this->redirectTo;
    }



}
