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
        return view('pages.profile.create'); // Tampilan form pembuatan profil baru (sesuaikan dengan kebutuhan)
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|string',
            'age' => 'required|integer|min:1',
            // Tambahkan validasi untuk field lain jika diperlukan
        ]);

        // Buat pengguna baru
        $user = new User();
        $user->name = $request->input('name');
        $user->gender = $request->input('gender');
        $user->age = $request->input('age');
        // Tambahkan field lain sesuai kebutuhan
        $user->save();

        return redirect()->route('profile.index')->with('success', 'Profil berhasil dibuat.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::findOrFail($id); // Ambil pengguna berdasarkan ID
        return view('pages.profile.update', compact('user')); // Tampilkan halaman edit profil
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:200',
            'age' => 'required|integer|min:1|max:100',
            'gender' => 'required|string',
            'email' => 'required|string|max:200',

        ]);

        $user = User::findOrFail($id); // Ambil pengguna berdasarkan ID

        // Perbarui data pengguna
        $user->name = $request->input('name');
        $user->gender = $request->input('gender');
        $user->age = $request->input('age');

        $user->save();

        return redirect()->route('profile.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id); // Ambil pengguna berdasarkan ID
        $user->delete(); // Hapus pengguna

        Auth::logout();
        return redirect()->view('pages.home.index');
    }
}
