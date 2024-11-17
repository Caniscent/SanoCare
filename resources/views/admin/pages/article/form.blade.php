@extends('admin.layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="py-12">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <form action="{{ $page_meta['url'] }}" method="post" enctype="multipart/form-data" novalidate>
                    @method($page_meta['method'])
                    @csrf
                    <!-- Field Title -->
                    <div class="mb-6">
                        <x-input-label for="name" :value="__('Judul Artikel')" />
                        <x-text-input id="title"  type="text" value="{{ old('title', $article->title) }}" name="title"/>
                        <x-input-error :messages="$errors->get('title')" class="mt-2" />
                    </div>

                    <!-- Field Content -->
                    <div class="mb-6">
                        <x-input-label for="content" :value="__('Konten')" />
                        <textarea class="form-control" id="content" name="content">{{ old('content', $article->content) }}</textarea>
                        <x-input-error :messages="$errors->get('content')" class="mt-2" />
                    </div>

                   <!-- Field Status -->
<div class="mb-6">
<label for="status" class="block mb-2 text-sm font-medium text-gray-700">Status</label>
<select id="status" name="status" class="form-control block w-full p-2.5 bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 ease-in-out">
    <option value="draft" {{ old('status', $article->status) == 'draft' ? 'selected' : '' }}>Draft</option>
    <option value="published" {{ old('status', $article->status) == 'published' ? 'selected' : '' }}>Published</option>
    <option value="archived" {{ old('status', $article->status) == 'rchived' ? 'selected' : '' }}>Archived</option>
</select>
@error('status')
    <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
@enderror
</div>
<!-- Field Image -->
<div class="mb-6">
    <x-input-label for="image" :value="__('Gambar Artikel')" />
    <input type="file" name="image" id="image" class="form-control block w-full p-2.5 bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 ease-in-out" />
    @if($article->image)
    <img src="{{ asset('storage/' . $article->image) }}" alt="Gambar Tempat" class="mt-2" width="150">
@endif
    <x-input-error :messages="$errors->get('image')" class="mt-2" />
</div>

<x-secondary-button >
<a href="{{route('admin.article.index')}}">Kembali</a>
</x-secondary-button>
                    <x-primary-button>
                        {{ $page_meta['submit_text'] }}
                    </x-primary-button>
                
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    ClassicEditor
        .create( document.querySelector( '#content' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
@endsection