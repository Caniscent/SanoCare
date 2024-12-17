@extends('admin.layouts.app')

@section('title', 'Makanan Pilihan')

@section('content')
    <div class="w-full max-w-xs mx-auto mt-12 overflow-x-auto lg:max-w-6xl">
        <h3 class="mb-4 text-xl font-bold">{{ $page_meta['title']}}</h3>
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
             <form action="{{ $page_meta['url'] }}" method="post" enctype="multipart/form-data" novalidate>
              @method($page_meta['method'])
              @csrf

              <!-- Input Baris 1 -->
              <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2">
                  <div>
                      <x-input-label for="food_name" :value="__('Nama Makanan')" />
                      <x-text-input id="food_name" type="text" value="{{ old('food_name', $clean_food->food_name ?? '') }}" name="food_name" class="block w-full" />
                      <x-input-error :messages="$errors->get('food_name')" class="mt-2" />
                  </div>
                  <div>
                      <x-input-label for="food_group_id" :value="__('Jenis Makanan')" />
                      <select id="food_group_id" name="food_group_id" class="block w-full p-2 bg-white border border-gray-300 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 max-h-40 overflow-y-auto">
                       <option value="" disabled {{ old('food_group_id', $clean_food->food_group_id ?? '') == '' ? 'selected' : '' }}>Pilih Kelompok</option>
                       @foreach ($foodGroups as $group)
                           <option value="{{ $group->id }}" {{ old('food_group_id', $clean_food->food_group_id ?? '') == $group->id ? 'selected' : '' }}>
                               {{ $group->group }}
                           </option>
                       @endforeach
                   </select>


                      <x-input-error :messages="$errors->get('food_group_id')" class="mt-2" />
                  </div>
              </div>

              <!-- Input Baris 2 -->
              <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2">
                  <div>
                      <x-input-label for="food_type_id" :value="__('Tipe Makanan')" />
                      <select id="food_type_id" name="food_type_id" class="block w-full p-2 bg-white border border-gray-300 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                       <option value="" disabled {{ old('food_type_id', $clean_food->food_type_id ?? '') == '' ? 'selected' : '' }}>Pilih Jenis</option>
                       @foreach ($foodTypes as $type)
                           <option value="{{ $type->id }}" {{ old('food_type_id', $clean_food->food_type_id ?? '') == $type->id ? 'selected' : '' }}>
                               {{ $type->type }}
                           </option>
                       @endforeach
                   </select>

                      <x-input-error :messages="$errors->get('food_type_id')" class="mt-2" />
                  </div>
                  <div>
                      <x-input-label for="calorie" :value="__('Kalori (kcal)')" />
                      <x-text-input id="calorie" type="number" value="{{ old('calorie', $clean_food->calorie ?? '') }}" name="calorie" class="block w-full" />
                      <x-input-error :messages="$errors->get('calorie')" class="mt-2"  step="0.01" min="0"  />
                  </div>
              </div>

              <!-- Input Baris 2 -->
              <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2">
                  <div>
                      <x-input-label for="protein" :value="__('Protein (g)')" />
                      <x-text-input id="protein" type="number" value="{{ old('protein', $clean_food->protein ?? '') }}"
                       name="protein" class="block w-full" step="0.01" min="0"  />
                      <x-input-error :messages="$errors->get('protein')" class="mt-2" />
                  </div>
                  <div>
                      <x-input-label for="fats" :value="__('Lemak (g)')" />
                      <x-text-input id="fats" type="number" value="{{ old('fats', $clean_food->fats ?? '') }}"
                        name="fats" class="block w-full" step="0.01" min="0"  />
                      <x-input-error :messages="$errors->get('fats')" class="mt-2" />
                  </div>
              </div>

              <!-- Input Baris 4 -->
              <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2">
                  <div>
                      <x-input-label for="carbs" :value="__('Karbohidrat (g)')" />
                      <x-text-input id="carbs" type="number" value="{{ old('carbs', $clean_food->carbs ?? '') }}"
                       name="carbs" class="block w-full" step="0.01" min="50"  />
                      <x-input-error :messages="$errors->get('carbs')" class="mt-2" />
                  </div>
                  <div>
                      <x-input-label for="fiber" :value="__('Serat (g)')" />
                      <x-text-input id="fiber" type="number" value="{{ old('fiber', $clean_food->fiber ?? '') }}"
                        name="fiber" class="block w-full"  step="0.01" min="0"  />
                      <x-input-error :messages="$errors->get('fiber')" class="mt-2" />
                  </div>
              </div>

              <!-- Tombol Aksi -->
              <div class="flex gap-4">
                  <x-secondary-button>
                      <a href="{{ route('admin.clean-food.index') }}">Kembali</a>
                  </x-secondary-button>
                  <x-primary-button>
                      {{ $page_meta['submit_text'] }}
                  </x-primary-button>
              </div>
          </form>

        </div>
    </div>


@endsection
