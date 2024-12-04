@extends('admin.layouts.app')

@section('title', 'Artikel')

@section('content')
    <div class="w-full max-w-xs mx-auto mt-12 overflow-x-auto lg:max-w-6xl">
        <h3 class="mb-4 text-xl font-bold">{{ $page_meta['title']}}</h3>
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <form action="{{ $page_meta['url'] }}" method="post" enctype="multipart/form-data" novalidate>
                    @method($page_meta['method'])
                    @csrf
                    <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2">
                        <div>
                            <x-input-label for="name" :value="__('Judul Artikel')" />
                            <x-text-input id="title" type="text" value="{{ old('title', $article->title) }}" name="title" class="block w-full" />
                            <x-input-error :messages="$errors->get('title')" class="mt-2" />
                        </div>
                        <div>
                            <x-input-label for="status" :value="__('Status')" />
                            <select id="status" name="status" class="form-control block w-full p-2.5 bg-white border border-gray-300
                             text-gray-900 text-sm rounded-lg focus:ring-indigo-500
                              focus:border-indigo-500 transition duration-150 ease-in-out">
                              @if ($article->status == 'draft')
                              <option value="draft" {{ old('status', $article->status) == 'draft' ? 'selected' : '' }}>Draft</option>
                              <option value="published" {{ old('status', $article->status) == 'published' ? 'selected' : '' }}>Published</option>
                              <option value="archived" {{ old('status', $article->status) == 'archived' ? 'selected' : '' }}>Archived</option>
                              @elseif ($article->status == 'published' || 'archived')
                              <option value="published" {{ old('status', $article->status) == 'published' ? 'selected' : '' }}>Published</option>
                              <option value="archived" {{ old('status', $article->status) == 'archived' ? 'selected' : '' }}>Archived</option>
                              @endif

                            </select>
                            @error('status')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                     <!-- Field Image -->
                     <div class="mb-6">
                        <x-input-label for="image" :value="__('Gambar Artikel')" />
                        <input type="file" name="image" id="image" class="form-control block w-full p-2.5 bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 ease-in-out" />
                        @if($article->image)
                        <img src="{{ asset('storage/' . $article->image) }}" alt="Gambar Artikel" class="mt-2 w-36">
                        @endif
                        <x-input-error :messages="$errors->get('image')" class="mt-2" />
                    </div>
                        <div class="mb-6">
                            <x-input-label for="content" :value="__('Konten')" />
                            <textarea class="form-control block w-full p-2.5 bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 transition duration-150 ease-in-out" id="content" name="content" rows="6">{{ old('content', $article->content) }}</textarea>
                            <x-input-error :messages="$errors->get('content')" class="mt-2" />
                        </div>

                    <div class="flex justify-end gap-4">
                        <x-secondary-button>
                            <a href="{{ route('admin.article.index') }}">Kembali</a>
                        </x-secondary-button>
                        <x-primary-button>
                            {{ $page_meta['submit_text'] }}
                        </x-primary-button>
                    </div>
                </form>
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
