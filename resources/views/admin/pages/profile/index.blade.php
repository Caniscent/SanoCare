@extends('admin.layouts.app')

@section('title', 'Profil Admin')

@section('content')
<div class="overflow-x-auto">
    <h1 class="text-3xl font-bold text-black mb-6">Profil Admin</h1>

    <div class="flex items-center mb-6">
        <img src="{{ asset('img/307ce493-b254-4b2d-8ba4-d12c080d6651.jpg') }}" alt="Profile Picture" class="w-32 h-32 rounded-full border-4 border-gray-300 shadow-lg" />
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

    <div class="mt-4 flex justify-between">
            <a href="{{ route('admin.profile.edit', [$user->id, 'action' => 'edit-profile']) }}" class="btn btn-primary bg-blue-500 hover:bg-blue-600 text-white">Edit Profil</a>
            <a href="{{ route('admin.profile.edit', [$user->id, 'action' => 'change-password']) }}" class="btn bg-gray-500 hover:bg-gray-600 text-white border-none">Ubah Password</a>

        {{-- <form action="{{ route('profile.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun ini?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger bg-red-500 hover:bg-red-600 text-white border-none">Hapus Akun</button>
        </form> --}}
    </div>

</div>
@endsection
