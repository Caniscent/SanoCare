<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('guest');
    }

       /**
     * Show the registration form for the given step.
     *
     * @param  Request  $request
     * @return \Illuminate\View\View
     */

     public function showRegistrationForm($step = 1)
     {

        if (!in_array($step, [1, 2])) {
            abort(404, 'Step not found.');
        }

        $data = [];
        if ($step == 1) {
            $data = session('register_step1', []);
        } elseif ($step == 2) {
            $data = session('register_step2', []);
        }

        return view('auth.register', [
            'step' => $step,
            'data' => $data,
        ]);
    }


      /**
     * Handle registration steps.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function handleStep(Request $request)
    {
        $step = $request->input('step', 1);

        if ($step == 1) {
            $validated = $request->validate([
                'name' => ['required', 'string', 'min:3', 'max:200'],
                'age' => ['required', 'integer', 'min:1', 'max:100'],
                'gender' => ['required','string','in:laki-laki,perempuan']
            ]);
            $request->session()->put('register_step1', $validated);
        }

        if ($step == 2) {
            $validated = $request->validate([
                'email' => ['required', 'email', 'max:200', 'unique:users'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);
            $request->session()->put('register_step2', $validated);
            $data = array_merge(
                $request->session()->get('register_step1', []),
                $request->session()->get('register_step2', [])
            );

            User::create([
                'name' => $data['name'],
                'age' => $data['age'],
                'gender' => $data['gender'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
                'role_id' => 2,
            ]);

            $request->session()->forget(['register_step1', 'register_step2']);
            return redirect()->route('login')->with('success', 'Registration successful');
        }

        return redirect()->route('register.showStep', ['step' => $step + 1]);
    }


}
