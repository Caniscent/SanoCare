@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-50">
    <div class="w-full max-w-md p-8 space-y-8 shadow-lg card bg-white">
        <div class="col-md-8">
            <div class="card">
                <h2 class="text-2xl font-bold text-center text-gray-800">Reset Password</h2>

                <div class="card-body">
                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="row mb-3">
                            <label for="email" class="label">
                                <span class="label-text text-black">Email</span>
                            </label>
                            <div class="col-md-6">
                                <input id="email" type="email" class="input input-bordered w-full bg-blue-200 text-black" name="email" value="{{ auth()->user()->email }}" readonly>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="label">
                                <span class="label-text text-black">Password</span>
                            </label>
                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control input input-bordered w-full bg-blue-200 text-black @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="label">
                                <span class="label-text text-black">Konfirmasi Password</span>
                            </label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control input input-bordered w-full bg-blue-200 text-black" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4 mt-10">
                                <button type="submit" class="btn btn-primary w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600">
                                    Reset Password
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
