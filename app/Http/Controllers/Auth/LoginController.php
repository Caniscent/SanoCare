<?php

namespace App\Http\Controllers\Auth;

use Log;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Session;
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
            'name' => 'required|min:3|max:200',
            'password' => 'required|min:8',
        ],[
            'name.required' => 'Nama wajib diisi!',
            'name.min' => 'Nama tidak boleh kurang dari 3 karakter!',
            'name.max' => 'Nama tidak boleh melebihi 200 karakter!',
            'password.required' => 'Password wajib diisi!',
            'password.min' => 'Password minimal 8 karakter!',
        ]
        );

        if (Auth::attempt($request->only('name', 'password'))) {
            $user = Auth::user();

            if ($user->role->name === 'admin') {
                return redirect()->route('admin.index');
            } elseif ($user->role->name === 'user') {
                return redirect()->route('meal-plan.index');
            } else {
                return redirect()->route('login')
                    ->with('error', 'Tidak memiliki akses.');
            }
        }

        return redirect()->route('login')
            ->with('error', 'Username atau password salah.');

    }

    public function logout(Request $request ){
        // dd($request);
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
