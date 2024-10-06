@extends('layouts.app')

@section('title')
    Home
@endsection


@section('content')
    <div class="hero min-h-screen" style="background-image: url('{{ asset('img/flat-lay-batch-cooking-composition.jpg') }}');">
    <div class="hero-overlay bg-opacity-60"></div>
    <div class="hero-content text-neutral-content text-center">
    <div class="max-w-md text-white">
        <h1 class="mb-5 text-5xl font-bold">Selamat Datang di <b>Sano Care!</b></h1>
        <p class="mb-5 ">
            Disini menyediakan penjadwalan makan untuk memenuhi kebutuhan diri anda agar dapat melakukan pencegahan dari penyakit diabetes.
        </p>
        <a class="btn btn-primary bg-blue-500 hover:bg-blue-600" href="{{route('check.create')}}">Mulai Sekarang</a>
    </div>
    </div>
    </div>
@endsection
