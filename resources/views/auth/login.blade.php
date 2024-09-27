@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-50">
    <div class="w-full max-w-md p-8 space-y-8 shadow-lg card bg-white">
        <h2 class="text-2xl font-bold text-center text-gray-800">{{ __('Login') }}</h2>

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <!-- Email Input -->
            <div class="form-control">
                <label for="email" class="label">
                    <span class="label-text">{{ __('Email Address') }}</span>
                </label>
                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus
                       class="input input-bordered w-full @error('email') input-error @enderror">
                @error('email')
                    <span class="text-error">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Password Input -->
            <div class="form-control">
                <label for="password" class="label">
                    <span class="label-text">{{ __('Password') }}</span>
                </label>
                <input id="password" type="password" name="password" required autocomplete="current-password"
                       class="input input-bordered w-full @error('password') input-error @enderror">
                @error('password')
                    <span class="text-error">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Remember Me Checkbox -->
            <div class="form-control">
                <label class="cursor-pointer label">
                    <input type="checkbox" name="remember" class="checkbox" {{ old('remember') ? 'checked' : '' }}>
                    <span class="label-text">{{ __('Remember Me') }}</span>
                </label>
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" class="btn btn-primary w-full">{{ __('Login') }}</button>
            </div>

            <!-- Forgot Password -->
            @if (Route::has('password.request'))
                <div class="text-center">
                    <a class="link link-primary" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a>
                </div>
            @endif

            @if (Route::has('register'))
                <div class="text-center">
                    <a class="link link-primary" href="{{ route('register') }}">
                        {{ __("Don't have account? register now") }}
                    </a>
                </div>
            @endif
        </form>
    </div>
</div>
@endsection
