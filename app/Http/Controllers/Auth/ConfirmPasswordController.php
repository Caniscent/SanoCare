<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\ConfirmsPasswords;

class ConfirmPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Confirm Password Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password confirmations and
    | uses a simple trait to include the behavior. You're free to explore
    | this trait and override any functions that require customization.
    |
    */

    use ConfirmsPasswords;

    /**
     * Where to redirect users when the intended url fails.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function passwordVerify()
    {
        return view('auth.passwords.confirm');
    }

    public function passwordVerifyProcess(Request $request)
    {
        $request->validate([
            'password' => 'required|string|min:8',
        ],[
            'password' => 'Password lama tidak sesuai',
        ]);
        $request->session()->put('password_validated', true);

        $user = Auth::user();

        if (!Hash::check($request->input('password'), $user->password)) {
            return back();
        }
        // dd($user->role_id);
        // dd($request->session()->all());
        if ($user->role_id == 1) {
            return redirect()->route('admin.profile.edit', $user->id);
        }else{
            return redirect()->route('profile.edit', $user->id);
        }

    }

}
