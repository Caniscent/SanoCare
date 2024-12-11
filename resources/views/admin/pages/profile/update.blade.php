@extends('admin.layouts.app')

@section('title', 'Profil Admin')

@section('content')
<div class="overflow-x-auto">
    <h1 class="text-3xl font-bold text-black mb-6">
        @if ($action === 'edit-profile')
            Edit <a href="{{ route('admin.profile.index') }}" class="text-blue-500 hover:underline">Profile</a>
        @elseif ($action === 'change-password')
            Ubah <a href="{{ route('admin.profile.index') }}" class="text-blue-500 hover:underline">Password</a>
        @endif
    </h1>

    @if ($action === 'edit-profile')
        <form action="{{ route('admin.profile.update', $user->id) }}" method="POST">
            @method('put')
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-900">Nama</label>
                <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}" required class="bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-blue-200 dark:border-blue-100 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @error('name')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="age" class="block text-sm font-medium text-gray-900">Usia</label>
                <input type="number" name="age" id="age" value="{{ old('age', $user->age) }}" required class="bg-gray-50 no-spinners border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-blue-200 dark:border-blue-100 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @error('age')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="gender" class="block text-sm font-medium text-gray-900">Jenis Kelamin</label>
                <select name="gender" id="gender" required class="bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-blue-200 dark:border-blue-100 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <option value="laki-laki" {{ $user->gender == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="perempuan" {{ $user->gender == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
                @error('gender')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-900">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email', $user->email) }}" required class="bg-gray-50 border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-blue-200 dark:border-blue-100 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-blue-500 dark:focus:border-blue-500">
                @error('email')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-4">
                <x-primary-button>
                    Simpan
                </x-primary-button>
                {{-- <button type="submit" class="btn btn-primary bg-blue-500 hover:bg-blue-600">Perbarui Profil</button> --}}
            </div>
        </form>
    @elseif ($action === 'change-password')
        <form action="{{ route('admin.profile.update', $user->id) }}" method="POST">
           
            @csrf
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-gray-900">Password Baru</label>
                <input type="password" name="password" id="password" required class="border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-blue-200 dark:border-blue-100 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Masukkan password baru">
                @error('password')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-4">
                <label for="password_confirmation" class="block text-sm font-medium text-gray-900">Konfirmasi Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required class="border text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-blue-200 dark:border-blue-100 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Konfirmasi password baru">
            </div>
            <div class="mb-4">
                <button type="submit" class="btn btn-primary bg-blue-500 hover:bg-blue-600 text-white">Ubah Password</button>
            </div>
        </form>
    @endif
</div>
@endsection
