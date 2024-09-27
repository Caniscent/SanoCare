@extends('layouts.app')


@section('title', 'Profile')

@section('content')
<div class="container mx-auto pb-[10rem] pt-[8rem]">
    <h1 class="text-2xl font-bold text-black">Profil Pengguna</h1>

    <div class="mt-4 text-black">
        <p><strong>Nama:</strong> {{ $user->name }}</p>
        <p><strong>Email:</strong> {{ $user->email }}</p>
        <p><strong>Tanggal Bergabung:</strong> {{ $user->created_at->format('d-m-Y') }}</p>
    </div>

    {{-- <div class="mt-4">
        <a href="{{ route('profile.edit', $user->id) }}" class="btn btn-primary">Edit Profil</a>
    </div> --}}
</div>
@endsection
