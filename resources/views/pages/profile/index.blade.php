@extends('layouts.app')

@section('title', 'Profile')

@section('content')
<div class="container mx-auto px-4 pt-[4rem] pb-[24.1rem]">
    <h1 class="text-3xl font-bold text-black mb-6">Profil Pengguna</h1>

    <div class="flex items-center mb-6">
        <img src="{{ asset('img/logonano.png') }}" alt="Profile Picture" class="w-32 h-32 rounded-full border-4 border-gray-300 shadow-lg" />
        <div class="ml-6 text-black">
            <h2 class="text-xl font-semibold">{{ $user->name }}</h2>

        </div>
    </div>

    <div class="mt-8 bg-gray-100 text-black p-4 rounded-lg shadow">
        <h3 class="text-2xl font-semibold text-black mb-4">Data Diri</h3>
        <p><strong>Usia:</strong> {{ $user->age }} tahun</p>
        <p><strong>Jenis Kelamin:</strong> {{ $user->gender }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Tanggal Bergabung:</strong> {{ $user->created_at->format('d-m-Y') }}</p>
    </div>

    {{-- <div class="mt-8 bg-gray-100 p-4 rounded-lg shadow">
        <h3 class="text-2xl font-semibold text-black mb-4">Riwayat Meal Plan</h3>
        @if($mealPlans->isEmpty())
            <p>Belum ada riwayat meal plan.</p>
        @else
            <ul class="list-disc pl-5">
                @foreach($mealPlans as $mealPlan)
                    <li>{{ $mealPlan->date->format('d-m-Y') }}: {{ $mealPlan->description }}</li>
                @endforeach
            </ul>
        @endif
    </div> --}}

    <div class="mt-4 flex justify-between">
        <a href="{{ route('profile.edit', $user->id) }}" class="btn btn-primary bg-blue-500 hover:bg-blue-600 text-white">Edit Profil</a>

        <form action="{{ route('profile.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun ini?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger bg-red-500 hover:bg-red-600 text-white">Hapus Akun</button>
        </form>
    </div>

</div>
@endsection
