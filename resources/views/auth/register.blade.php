@extends('layouts.app')

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
                        <span class="label-text text-black">{{ __('Name') }}</span>
                    </label>
                    <input id="name" type="text" class="input input-bordered @error('name') input-error @enderror bg-blue-200 text-black" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                        <span class="text-error text-sm">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-control mb-4">
                    <label for="email" class="label">
                        <span class="label-text text-black">{{ __('Email Address') }}</span>
                    </label>
                    <input id="email" type="email" class="input input-bordered @error('email') input-error @enderror bg-blue-200 text-black" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                    <input id="password" type="password" class="input input-bordered @error('password') input-error @enderror bg-blue-200 text-black" name="password" required autocomplete="new-password">

                    @error('password')
                        <span class="text-error text-sm">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-control mb-4">
                    <label for="password-confirm" class="label">
                        <span class="label-text text-black">{{ __('Confirm Password') }}</span>
                    </label>
                    <input id="password-confirm" type="password" class="input input-bordered bg-blue-200 text-black" name="password_confirmation" required autocomplete="new-password">
                </div>

                <div class="form-control mt-10">
                    <button type="submit" class="btn btn-primary w-full">
                        {{ __('Register') }}
                    </button>
                </div>

                {{-- Login --}}
                @if (Route::has('login'))
                    <div class="text-center mt-3">
                        <a class="text-blue-700 hover:underline" href="{{ route('login') }}">
                            {{ __('Back to login') }}
                        </a>
                    </div>
                @endif
            </form>
        </div>
    </div>
</div>
@endsection
