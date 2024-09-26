@extends('layouts.app')

@section('title')
    Home
@endsection


@section('content')
    <div
    class="hero min-h-screen"
    style="background-image: url(https://img.daisyui.com/images/stock/photo-1507358522600-9f71e620c44e.webp);">
    <div class="hero-overlay bg-opacity-60"></div>
    <div class="hero-content text-neutral-content text-center">
    <div class="max-w-md text-white">
        <h1 class="mb-5 text-5xl font-bold">Hello there</h1>
        <p class="mb-5 ">
        Welcome to <b>Sano Care</b>!
        in here we provide various checkup for your healthy life<br>
        so what are you waiting for? lets get started
        </p>
        <a class="btn btn-primary bg-blue-400" href="{{route('check.index')}}">Get Started</a>
    </div>
    </div>
    </div>
@endsection
