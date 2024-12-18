<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        return view('pages.profile.index', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.profile.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|string',
            'age' => 'required|integer|min:1',
        ]);

        $user = new User();
        $user->name = $request->input('name');
        $user->gender = $request->input('gender');
        $user->age = $request->input('age');
        $user->save();

        return redirect()->route('profile.index')->with('success', 'Profil berhasil dibuat.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, string $id)
    {
        $user = Auth::user();

        $action = $request->query('action', 'change-password');
        if ($action === 'change-password') {
            if (!$request->session()->has('password_validated')) {
                return redirect()->route('password.verify');
            }
            $request->session()->forget('password_validated');
        }

        $user = User::findOrFail($id);

        return view('pages.profile.update', compact('user', 'action'));
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::findOrFail($id);

        if ($request->has('password')) {
            $request->validate([
                'password' => 'required|string|min:8|confirmed',
            ],[
                'password'=> 'Password harus memiliki panjang minimal 8'
            ]);

            $user->password = bcrypt($request->input('password'));
            $user->save();

            return redirect()->route('profile.index')->with('success', 'Password berhasil diubah.');
        } else {
            $request->validate([
                'name' => 'required|string|min:3|max:200',
                'age' => 'required|integer|min:3|max:100',
                'gender' => 'required|string',
                'email' => 'required|string|max:200|email',
            ]);

            $user->name = $request->input('name');
            $user->gender = $request->input('gender');
            $user->age = $request->input('age');
            $user->email = $request->input('email');
            $user->save();

            return redirect()->route('profile.index')->with('success', 'Profil berhasil diperbarui.');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        Auth::logout();
        return redirect()->route('login');
    }
}
