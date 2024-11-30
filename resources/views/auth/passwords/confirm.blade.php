@extends('layouts.app')

@section('title','Confirm Password')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-50">
    <div class="w-full max-w-md p-8 space-y-8 shadow-lg card bg-white">
        <h2 class="text-2xl font-bold text-center text-gray-800">
            <a href="{{route('home')}}" class="text-2xl font-bold text-center text-blue-400 hover:underline">{{ __('Sano Care') }}</a>
            {{ __('Confirm Password') }}
        </h2>

        <div class="card-body">
            <p class="text-center text-gray-700">{{ __('Konfirmasi password sebelum melanjutkan') }}</p>

            <form method="POST" action="{{ route('password.verify-process') }}" class="space-y-6">
                @csrf

                <!-- Password Input -->
                <div class="form-control">
                    <label for="password" class="label">
                        <span class="label-text text-black">{{ __('Password') }}</span>
                    </label>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                           class="input input-bordered w-full @error('password') input-error @enderror bg-blue-200 text-black" autofocus>
                    @error('password')
                        <span class="text-red-500 text-sm">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-control">
                    <button type="submit" class="btn btn-primary w-full bg-blue-500 hover:bg-blue-600">{{ __('Confirm Password') }}</button>
                </div>

                <!-- Forgot Password -->
                @if (Route::has('password.request'))
                    <div class="text-center">
                        <a class="text-blue-400 hover:underline" href="{{ route('password.request') }}">
                            {{ __('Lupa password anda?') }}
                        </a>
                    </div>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection
