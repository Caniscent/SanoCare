@extends('layouts.app')

@section('title', 'Article')

@section('content')
<div class="pt-[4rem] pb-[5rem]">
    <h3 class="text-4xl font-bold mb-4 text-center text-gray-900 pb-12">Artikel</h3>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden ">
            <div class="p-6 text-gray-900">
                {{-- <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6"> --}}
                   <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                   @foreach ($article as $data)
                    <div class="bg-gray-100 p-4 rounded-lg shadow">
                        <h4 class="font-semibold text-lg mb-2">{{$data->title}}</h4>
                        <p class="text-sm text-gray-600 mb-4">Diterbitkan pada {{$data->published_at->format('d M Y')}}</p>
                        <p class="text-gray-700">
                            {!! \Illuminate\Support\Str::limit($data->content, 150) !!}
                        </p>
                        <a href="{{route('article.detail', $data->slug)}}" class="mt-4 inline-block text-blue-600 hover:underline">Baca selengkapnya</a>
                    </div>


                   @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
