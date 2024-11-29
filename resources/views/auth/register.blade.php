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
            @if ($step == 1)
            <form method="POST" action="{{ route('register.step') }}">
                @csrf
                <input type="hidden" name="step" value="1">

                <div class="form-control mb-4">
                    <label for="name" class="label">
                        <span class="label-text text-black">{{ __('Nama') }}</span>
                    </label>
                    <input
                        type="text"
                        name="name"
                        id="name"
                        class="input input-bordered w-full @error('name') input-error @enderror bg-blue-200 text-black"
                        value="{{ old('name') }}"
                        placeholder="Masukkan nama Anda"
                        required
                        autofocus>
                    @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="form-control mb-4">
                    <label for="age" class="label">
                        <span class="label-text text-black">{{ __('Usia') }}</span>
                    </label>
                    <input
                        type="number"
                        name="age"
                        id="age"
<<<<<<< HEAD
                        class="input input-bordered w-full @error('age') input-error @enderror bg-blue-200 text-black"
=======
                        class="input input-bordered w-full @error('age')f input-error @enderror bg-blue-200 text-black no-spinners"
>>>>>>> 5403de53505270dcf8999d196202a55c8c2f1a5e

                        value="{{ old('age') }}"
                        placeholder="Masukkan usia Anda"
                        required>
                    @error('age') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="form-control mb-4">
                    <label for="gender" class="label">
                        <span class="label-text text-black">{{ __('Jenis Kelamin') }}</span>
                    </label>
                    <select
                        name="gender"
                        id="gender"
                        class="w-full select select-bordered  bg-blue-200 text-black">
                        <option value="" disabled selected>{{ __('Pilih jenis kelamin') }}</option>
                        <option value="laki-laki" {{ old('gender') == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="perempuan" {{ old('gender') == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>
                    @error('gender') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="submit" class="btn btn-primary w-full mb-2 bg-blue-500 hover:bg-blue-600">{{ __('Next') }}</button>
                </div>
                    {{-- Login --}}
                @if (Route::has('login'))
                <div class="text-center text-black">
                    {{__("Sudah punya akun?")}}
                    <a class="text-blue-400 hover:underline" href="{{ route('login') }}">
                        {{ __("Login") }}
                    </a>
                </div>
            @endif
            @elseif ($step == 2)
            </form>
            {{-- Step 2: Account Information --}}
            <form method="POST" action="{{ route('register.step') }}">
                @csrf
                <input type="hidden" name="step" value="2">

                <div class="mb-4">
                    <label for="email" class="label">Email</label>
                    <input
                        type="email"
                        name="email"
                        id="email"
                        class="input input-bordered w-full @error('email') input-error @enderror bg-blue-200 text-black
                        value="{{ old('email') }}"
                        placeholder="Masukkan email Anda"
                        required>
                    @error('email') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="password" class="label">Password</label>
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="input input-bordered w-full @error('password') input-error @enderror bg-blue-200 text-black"
                        placeholder="Masukkan password">
                    @error('password') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-4">
                    <label for="password_confirmation" class="label">Konfirmasi Password</label>
                    <input
                        type="password"
                        name="password_confirmation"
                        id="password_confirmation"
                        class="input input-bordered w-full bg-blue-200 text-black"
                        placeholder="Konfirmasi password">
                </div>

                <div class="flex justify-between items-center w-full space-x-4">
                    <a href="{{ route('register.showStep', ['step' => 1]) }}"
                       class="btn btn-secondary w-1/4 text-center border-0 bg-gray-500 hover:bg-gray-600 text-white py-2 px-4 rounded">
                        Back
                    </a>

                    <button type="submit"
                            class="btn btn-primary w-1/4 bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">
                        {{ __('Register') }}
                    </button>
                </div>

        </form>
        @endif
    </div>
</div>
</div>
@endsection
