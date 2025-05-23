<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{


    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

     protected function redirectTo()
     {
         $user = Auth::user();

         if ($user->role === 'admin') {
             return '/admin/pemberkasan';
         } elseif ($user->role === 'orangtua') {
             return '/orangtua/profile';
         }

         return '/home'; // Default jika tidak ada role yang cocok
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
}
