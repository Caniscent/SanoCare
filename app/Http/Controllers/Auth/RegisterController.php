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

    public function showRegistrationForm(Request $request)
    {
        $step = $request->session()->get('register_step', 1);
        return view('auth.register', compact('step'));
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
            return $this->validateStep1($request);
        }elseif ($step == 2){
            return $this->validateStep2($request);
        }
        return redirect()->route('register');
    }
     /**
     * Validate step 1: Basic information.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    private function validateStep1(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'min:3', 'max:200'],
            'age' => ['required', 'integer', 'min:1', 'max:100'],
            'gender' => ['required', 'in:laki-laki,perempuan'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Save step 1 data in session
        $request->session()->put('register_step_1', $request->only(['name', 'age', 'gender']));
        $request->session()->put('register_step', 2);

        return redirect()->route('register');
    }
      /**
     * Validate step 2: Account information.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    private function validateStep2(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'string', 'email', 'max:200', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'max:50', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Save step 2 data in session
        $request->session()->put('register_step_2', $request->only(['email', 'password']));

        // Create user and clear session
        return $this->createUser($request);
    }

    /**
     * Create a new user after step 2.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    private function createUser(Request $request)
    {
        $step1 = $request->session()->get('register_step_1');
        $step2 = $request->session()->get('register_step_2');

        if (!$step1 || !$step2) {
            return redirect()->route('register')->withErrors(['error' => 'Session expired. Please start again.']);
        }

        // Save user
        User::create([
            'name' => $step1['name'],
            'age' => $step1['age'],
            'gender' => $step1['gender'],
            'email' => $step2['email'],
            'password' => Hash::make($step2['password']),
            'role' => 1,
        ]);

        // Clear session
        $request->session()->forget(['register_step', 'register_step_1', 'register_step_2']);

        return redirect($this->redirectTo)->with('success', 'Registration successful.');
    }
}
