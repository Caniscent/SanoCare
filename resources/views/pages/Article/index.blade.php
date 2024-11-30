@extends('layouts.app')

@section('title', 'Article')

@section('content')
<div class="container-fluid mx-auto px-4 pt-[1rem] pb-[24.1rem]">
    <h3 class="text-2xl font-bold text-center mt-6">Artikel</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 p-6">
        <!-- Card 1 -->
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <h2 class="card-title">Judul Artikel 1</h2>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptates, velit?</p>
                <div class="card-actions justify-end">
                    <button class="btn btn-primary">Read More</button>
                </div>
            </div>
        </div>

        <!-- Card 2 -->
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <h2 class="card-title">Judul Artikel 2</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, autem?</p>
                <div class="card-actions justify-end">
                    <button class="btn btn-primary">Read More</button>
                </div>
            </div>
        </div>

        <!-- Card 3 -->
        <div class="card bg-base-100 shadow-xl">
            <div class="card-body">
                <h2 class="card-title">Judul Artikel 3</h2>
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Aspernatur, vitae.</p>
                <div class="card-actions justify-end">
                    <button class="btn btn-primary">Read More</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
