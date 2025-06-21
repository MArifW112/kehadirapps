<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
    protected $redirectTo = '/home';

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

    /**
     * Handle response after user authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
    public function authenticated(Request $request, $user)
    {
        // Cek jika request dari API (expects JSON)
        if ($request->expectsJson()) {
            // Menangani login API (misal untuk mobile)
            return response()->json([
                'message' => 'Login successful',
                'token' => $user->createToken('authToken')->plainTextToken,
                'user' => $user
            ], 200);
        }

        // Cek role user untuk login via web
        if ($user->hasRole('admin')) {
            // Jika user memiliki role 'admin', redirect ke halaman admin
            return redirect()->route('home');
        }

        // Jika bukan admin, redirect ke halaman user biasa
        return redirect()->route('user.page');
    }

    /**
     * Handle logout request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     */
}
