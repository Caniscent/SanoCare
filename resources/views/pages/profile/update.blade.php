@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')
<div class="container mx-auto px-4 pt-[4rem] pb-[24.1rem]">
    <h1 class="text-3xl font-bold text-black mb-6">Edit Profil</h1>

    <form action="{{ route('profile.update', $user->id) }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Nama</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
            @error('name')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="gender" class="block text-sm font-medium text-gray-700">Jenis Kelamin</label>
            <select name="gender" id="gender" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
                <option value="laki-laki" {{ $user->gender == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                <option value="perempuan" {{ $user->gender == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
            </select>
            @error('gender')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <label for="age" class="block text-sm font-medium text-gray-700">Usia</label>
            <input type="number" name="age" id="age" value="{{ old('age', $user->age) }}" required class="mt-1 block w-full p-2 border border-gray-300 rounded-md">
            @error('age')
                <span class="text-red-500 text-sm">{{ $message }}</span>
            @enderror
        </div>

        <div class="mb-4">
            <button type="submit" class="btn btn-primary bg-blue-500 hover:bg-blue-600">Perbarui Profil</button>
        </div>
    </form>


</div>
@endsection
