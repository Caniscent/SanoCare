@extends('layouts.app')

@section('title','auth')

@section('content')
<div class="flex justify-center items-center min-h-screen">
    <div class="card w-full max-w-md shadow-lg bg-gray-50">
        <div class="card-body">
            <h2 class="text-2xl font-bold text-center text-gray-800">
                <a href="{{url('/')}}" class="text-2xl font-bold text-center text-blue-400 hover:underline">{{ __('Sano Care') }}</a>
                {{ __('Register') }}
            </h2>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-control mb-4">
                    <label for="name" class="label">
                        <span class="label-text text-black">{{ __('Nama') }}</span>
                    </label>
                    <input id="name" type="text" class="input input-bordered @error('name') input-error @enderror bg-blue-200 text-black" name="name" value="{{ old('name') }}" placeholder="Masukkan nama anda" required autocomplete="name" autofocus>

                    @error('name')
                        <span class="text-error text-sm">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-control mb-4">
                    <label for="age" class="label">
                        <span class="label-text text-black">{{ __('Usia') }}</span>
                    </label>
                    <input id="age" type="number" class="input input-bordered @error('age') input-error @enderror bg-blue-200 text-black no-spinners" name="age" value="{{ old('age') }}" placeholder="Masukkan usia anda" required autocomplete="age" autofocus>

                    @error('age')
                        <span class="text-error text-sm">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-control mb-4">
                    <label for="gender" class="label">
                        <span class="label-text text-black">{{ __('Jenis Kelamin') }}</span>
                    </label>
                    <select id="gender" class="input input-bordered @error('gender') input-error @enderror bg-blue-200 text-black" name="gender" required>
                        <option value="" disabled selected>{{ __('Pilih jenis kelamin') }}</option>
                        <option value="laki-laki" {{ old('gender') == 'laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                        <option value="perempuan" {{ old('gender') == 'perempuan' ? 'selected' : '' }}>Perempuan</option>
                    </select>

                    @error('gender')
                        <span class="text-error text-sm">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-control mb-4">
                    <label for="email" class="label">
                        <span class="label-text text-black">{{ __('Email') }}</span>
                    </label>
                    <input id="email" type="email" class="input input-bordered @error('email') input-error @enderror bg-blue-200 text-black" name="email" value="{{ old('email') }}" placeholder="Masukkan email anda" required autocomplete="email">

                    @error('email')
                        <span class="text-error text-sm">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-control mb-4">
                    <label for="password" class="label">
                        <span class="label-text text-black">{{ __('Password') }}</span>
                    </label>
                    <input id="password" type="password" class="input input-bordered @error('password') input-error @enderror bg-blue-200 text-black" name="password" placeholder="Buat password dengan panjang minimal 8" required autocomplete="new-password">

                    @error('password')
                        <span class="text-error text-sm">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-control mb-4">
                    <label for="password-confirm" class="label">
                        <span class="label-text text-black">{{ __('Konfirmasi Password') }}</span>
                    </label>
                    <input id="password-confirm" type="password" class="input input-bordered bg-blue-200 text-black" name="password_confirmation" placeholder="Konfirmasi password anda" required autocomplete="new-password">
                </div>

                <div class="form-control mt-10">
                    <button type="submit" class="btn btn-primary w-full bg-blue-500 hover:bg-blue-600">
                        {{ __('Register') }}
                    </button>
                </div>

                {{-- Login --}}
                @if (Route::has('login'))
                    <div class="text-center mt-3">
                        <a class="text-blue-400 hover:underline" href="{{ route('login') }}">
                            {{ __('Kembali ke login') }}
                        </a>
                    </div>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection
