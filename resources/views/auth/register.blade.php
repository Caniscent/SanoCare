@extends('layouts.app')

@section('title', 'Register')

@section('content')
<div class="flex justify-center items-center min-h-screen">
    <div class="card w-full bg-blue-200 max-w-md shadow-lg bg-gray-50">
        <div class="card-body">
            <h2 class="text-2xl font-bold text-center text-gray-800">
                <a href="{{url('/')}}" class="text-2xl font-bold text-center text-blue-400 hover:underline">{{ __('Sano Care') }}</a>
                {{ __('Register') }}
            </h2>
        <form method="POST" action="{{ route('register.step') }}">
            @csrf
            {{-- Hidden input to track current step --}}
            <input type="hidden" name="step" value="{{ $step }}">

            {{-- Step 1: Basic Information --}}
            @if ($step == 1)
                <div class="form-control mb-4">
                    <label for="name" class="label">Nama</label>
                    <input 
                        type="text" 
                        name="name" 
                        id="name" 
                        class="w-full bg-blue-200  border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500" 
                        value="{{ old('name') }}"
                        placeholder="Masukkan nama Anda">
                    @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="form-control mb-4">
                    <label for="age" class="label">Usia</label>
                    <input 
                        type="number" 
                        name="age" 
                        id="age" 
                        class="w-full bg-blue-200 border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500" 
                        value="{{ old('age') }}"
                        placeholder="Masukkan usia Anda">
                    @error('age') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="form-control mb-4">
                    <label for="gender" class="label">Jenis Kelamin</label>
                    <select 
                        name="gender" 
                        id="gender" 
                        class="w-full bg-blue-200 border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500">
                        <option value="laki-laki" {{ old('gender') == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="perempuan" {{ old('gender') == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('gender') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="text-right">
                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-2 px-4 rounded-lg">Next</button>
                </div>
            @endif

            {{-- Step 2: Account Information --}}
            @if ($step == 2)
                <div class="mb-4">
                    <label for="email" class="label">Email</label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        class="w-full bg-blue-200 border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500" 
                        value="{{ old('email') }}"
                        placeholder="Masukkan email Anda">
                    @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="password" class="label">Password</label>
                    <input 
                        type="password" 
                        name="password" 
                        id="password" 
                        class="w-full bg-blue-200 border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500" 
                        placeholder="Masukkan password">
                    @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>
                <div class="mb-4">
                    <label for="password_confirmation" class="label">Konfirmasi Password</label>
                    <input 
                        type="password" 
                        name="password_confirmation" 
                        id="password_confirmation" 
                        class="w-full bg-blue-200 border border-gray-300 rounded-lg p-2 focus:ring-blue-500 focus:border-blue-500" 
                        placeholder="Konfirmasi password">
                </div>
                <div class="flex justify-between items-center">
                    <button type="submit" class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-lg">Register</button>
                </div>
            @endif
        </form>
    </div>
</div>
</div>
@endsection
