@extends('admin.layouts.app')

@section('title', 'Jenis Makanan')

@section('content')
    <div class="w-full max-w-xs mx-auto mt-12 overflow-x-auto lg:max-w-6xl">
        <h3 class="mb-4 text-xl font-bold">{{ $page_meta['title']}}</h3>
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
             <form action="{{ $page_meta['url'] }}" method="post" enctype="multipart/form-data" novalidate>
              @method($page_meta['method'])
              @csrf

              <!-- Input Baris 1 -->
              <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-3">
                  <div>
                      <x-input-label :value="__('Nama Jenis')" />
                      <x-text-input type="text"
                                    value="{{ old('group', $food_group->group ?? '') }}"
                                    name="group"
                                    class="block w-full" />
                      <x-input-error :messages="$errors->get('group')" class="mt-2" />
                  </div>
                  <div>
                      <x-input-label :value="__('Deskripsi')" />
                      <x-text-input type="text"
                                    value="{{ old('description', $food_group->description ?? '') }}"
                                    name="description"
                                    class="block w-full" />
                      <x-input-error :messages="$errors->get('description')" class="mt-2" />
                  </div>
                  <div>
                   <x-input-label :value="__('Status')" />
                   <label class="flex items-center relative w-14 h-7 cursor-pointer select-none mt-2">
                    <input type="checkbox"
                           name="status"
                           class="sr-only peer"
                           value="1"
                           {{ old('status', $food_group->status ?? false) ? 'checked' : '' }} />
                    <div class="w-14 h-7 bg-red-500 rounded-full peer-focus:ring-2 peer-focus:ring-offset-2 peer-focus:ring-offset-black peer-focus:ring-blue-500 transition-colors peer-checked:bg-green-500"></div>
                    <div class="absolute w-6 h-6 bg-gray-200 rounded-full top-0.5 left-0.5 transition-transform peer-checked:translate-x-7"></div>
                    <span class="absolute left-7 text-xs font-medium text-white uppercase peer-checked:hidden">OFF</span>
                    <span class="absolute right-7 text-xs font-medium text-white uppercase hidden peer-checked:inline">ON</span>
                </label>
                <x-input-error :messages="$errors->get('status')" class="mt-2" />
                  </div>
              </div>

              <!-- Tombol Aksi -->
              <div class="flex gap-4">
                  <x-secondary-button>
                      <a href="{{ route('admin.food-group.index') }}">Kembali</a>
                  </x-secondary-button>
                  <x-primary-button>
                      {{ $page_meta['submit_text'] }}
                  </x-primary-button>
              </div>
          </form>


        </div>
    </div>

    <style>
     body {
         background-color: #171717; /* bg-true-gray-900 */
     }

     input:checked {
         background-color: #22c55e; /* bg-green-500 */
     }

     input:checked + span {
         transform: translateX(1.75rem); /* translate-x-7 */
     }
 </style>
@endsection
