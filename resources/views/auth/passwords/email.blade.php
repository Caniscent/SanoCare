@extends('layouts.app')

@section('title','auth')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-50">
    <div class="w-full max-w-md p-8 space-y-8 shadow-lg card bge-whit">
        <h2 class="text-2xl font-bold text-center text-gray-800">
            {{ __('Reset Password') }}
        </h2>

        @if (session('status'))
            <div class="alert alert-success text-green-600 bg-green-100 p-4 rounded-md">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
            @csrf

            <!-- Email Input -->
            <div class="form-control">
                <label for="email" class="label">
                    <span class="label-text text-black">Email</span>
                </label>
                @if (auth())
                    <input id="email" type="email" class="input input-bordered w-full bg-blue-200 text-black" name="email" placeholder="Masukkan email anda" autofocus>
                @elseif (auth())
                    <input id="email" type="email" class="input input-bordered w-full bg-blue-200 text-black" name="email" value="{{ auth()->user()->email }}" readonly>
                @endif
                @error('email')
                    <span class="text-error text-red-500 text-sm">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>

            <!-- Submit Button -->
            <div>
                <button type="submit" class="btn btn-primary w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600">
                    Kirim
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
