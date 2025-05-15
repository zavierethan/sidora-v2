<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;

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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectPath()
    {
        if (Auth::user()->role_id == 2 || Auth::user()->role_id == 3) {
            return '/transaksi/olahraga-prestasi'; // Redirect admins to the admin dashboard
        }

        if (Auth::user()->role_id == 4) {
            return '/transaksi/olahraga-masyarakat'; // Redirect admins to the admin dashboard
        }

        if (Auth::user()->role_id == 5 || Auth::user()->role_id == 6) {
            return '/transaksi/keolahragaan'; // Redirect admins to the admin dashboard
        }

        return '/home';
    }

    public function username()
    {
        return 'name';
    }
}
