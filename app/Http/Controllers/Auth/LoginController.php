<?php

namespace App\Http\Controllers\Auth;

use Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

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
    protected $redirectTo = '/';

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'name';
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

    /**
     * Create a new controller instance.
     *
     * @return RedirectResponse
     */
    public function login(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required',
            'password' => 'required',
        ]);

        if (Auth::attempt($request->only('name', 'password'))) {
            $user = Auth::user();

            if ($user->role->name === 'admin') {
                return redirect()->route('admin.index');
            } elseif ($user->role->name === 'user') {
                return redirect()->route('meal-plan.index');
            } else {
                return redirect()->route('login')
                    ->with('error', 'Your role does not have access.');
            }
        }

        return redirect()->route('login')
            ->with('error', 'Invalid username or password.');

    }
}
