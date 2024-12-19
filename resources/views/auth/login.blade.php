@extends('layouts.app')

@section('title','auth')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-50">
    <div class="w-full max-w-md p-8 space-y-8 shadow-lg card bg-white">
        <h2 class="text-2xl font-bold text-center text-gray-800">
            <a href="{{route('home')}}" class="text-2xl font-bold text-center text-blue-400 hover:underline">Sano Care</a>
            Login
        </h2>

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <!-- Name Input -->
            <div class="form-control">
                <label for="name" class="label">
                    <span class="label-text text-black">Nama</span>
                </label>
                <input id="name" type="text" name="name" value="{{ old('name') }}"
                       class="input input-bordered w-full @error('name') input-error @enderror bg-blue-200 text-black">
                @error('name')
                    <span class="text-red-500 text-sm">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
                {{-- @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror --}}
                @if(session('error'))
                <span class="text-red-500 text-sm">
                    <strong>{{session('error')}}</strong>
                </span>
            @endif
            </div>


            <!-- Password Input -->
            <div class="form-control">
                <label for="password" class="label">
                    <span class="label-text text-black">Password</span>
                </label>
                <div class="relative">
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                           class="input input-bordered w-full @error('password') input-error @enderror bg-blue-200 text-black">
                    <button type="button" onclick="togglePassword()" class="absolute right-3 top-3">
                        <img src="{{ asset('img/icons/eye-regular.svg') }}" alt="Info" class="w-5 h-5">
                    </button>
                </div>
                @error('password')
                    <span class="text-red-500 text-sm">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Remember Me Checkbox -->
            <div class="form-control justify-between">
                <label class="label ">
                    <input type="checkbox" name="remember" class="checkbox bg-blue-50" {{ old('remember') ? 'checked' : '' }}>
                    <span class="label-text text-black pr-[7rem]">Ingat Saya</span>
                    <!-- Forgot Password -->
                    @if (Route::has('password.request'))
                    <a class="text-blue-400 hover:underline" href="{{ route('password.request') }}">
                        Lupa password anda?
                    </a>
                    @endif
                </label>
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" class="btn btn-primary w-full bg-blue-500 hover:bg-blue-600 text-white">Login</button>
            </div>


            {{-- Register --}}
            @if (Route::has('register'))
                <div class="text-center text-black">
                    {{__("Belum punya akun Sano Care?")}}
                    <a class="text-blue-400 hover:underline" href="{{ route('register') }}">
                        Register
                    </a>
                </div>
            @endif
        </form>
    </div>
</div>

<script>
    function togglePassword() {
        var passwordField = document.getElementById('password');
        var passwordType = passwordField.type === "password" ? "text" : "password";
        passwordField.type = passwordType;
    }
</script>
@endsection
