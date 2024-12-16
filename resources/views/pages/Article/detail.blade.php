@extends('layouts.app')

@section('title', 'Article')

@section('content')
<div class="pt-[4rem] pb-[5rem]">
 <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
     <div class="bg-white overflow-hidden">
         <div class="p-6 text-gray-900">
             <div class="flex flex-col lg:flex-row">
                 <div class="w-full">
                     <header class="mb-4">
                         <h1 class="text-3xl font-bold mb-2">{{ $article->title }}</h1>
                         <p class="text-gray-600 mb-4">Ditulis pada {{ $article->created_at->format('d M Y') }}</p>
                         {{-- @if($article->image) --}}
                         <img src="{{ asset('storage/' . $article->image) }}" alt="{{ $article->title }}" class="w-half h-auto mb-4">
                         {{-- @endif --}}
                         <div class="prose max-w-none">
                             {!! ($article->content) !!}
                         </div>
                     </header>
                 </div>

           </div>
             <div class="mt-8">
                 <a href="{{ route('article.index') }}" class="inline-block bg-gray-900 text-white px-4 py-2 rounded hover:bg-gray-700">
                    Kembali
                 </a>
             </div>
         </div>
     </div>
 </div>
</div>
@endsection
