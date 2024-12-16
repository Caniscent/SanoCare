@extends('admin.layouts.app')

@section('title', 'Profil Admin')

@section('content')
<div class="overflow-x-auto">
    <h1 class="mb-6 text-3xl font-bold text-black">Profil Admin</h1>

    <div class="flex items-center mb-6">
        <img src="{{ asset('img/307ce493-b254-4b2d-8ba4-d12c080d6651.jpg') }}" alt="Profile Picture" class="w-32 h-32 border-4 border-gray-300 rounded-full shadow-lg" />
        <div class="ml-6 text-black">
            <h2 class="text-xl font-semibold">{{ $user->name }}</h2>

        </div>
    </div>

    <div class="p-4 mt-8 text-black bg-gray-100 rounded-lg shadow">
        <h3 class="mb-4 text-2xl font-semibold text-black">Data Diri</h3>
        <p><strong>Usia:</strong> {{ $user->age }} tahun</p>
        <p><strong>Jenis Kelamin:</strong> {{ $user->gender }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Tanggal Bergabung:</strong> {{ $user->created_at->format('d-m-Y') }}</p>
    </div>

    <div class="flex gap-2 mt-4">
            <x-primary-button >
                <a href="{{ route('admin.profile.edit', [$user->id, 'action' => 'edit-profile']) }}">
                    Edit Profil
                </a>
            </x-primary-button>
            <x-danger-button >
                <a href="{{ route('admin.profile.edit', [$user->id, 'action' => 'change-password']) }}" >Ubah Password</a>
            </x-danger-button>
        {{-- <form action="{{ route('profile.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus akun ini?');">
            @csrf
            @method('DELETE')
            <button type="submit" class="text-white bg-red-500 border-none btn btn-danger hover:bg-red-600">Hapus Akun</button>
        </form> --}}
    </div>

</div>
@endsection
