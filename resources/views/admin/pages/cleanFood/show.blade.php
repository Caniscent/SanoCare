@extends('admin.layouts.app')

@section('title', 'Makanan Pilihan')

@section('content')
    <div class="w-full max-w-xs mx-auto mt-12 overflow-x-auto lg:max-w-6xl">
        <h3 class="mb-4 text-xl font-bold">{{ $page_meta['title']}}</h3>
        <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">          
              {{-- <div class="container mx-auto p-6 bg-white rounded-lg shadow-lg"> --}}
    {{-- <h1 class="text-2xl font-bold text-gray-800 mb-6">Detail Informasi Makanan</h1> --}}
    
    <!-- Baris 1 -->
    <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2">
        <div class="flex items-center">
            <div class="w-1/3 text-gray-600 font-semibold">Nama Makanan:</div>
            <div class="w-2/3 text-gray-800">{{ $clean_food->food_name ?? '-' }}</div>
        </div>
        <div class="flex items-center">
            <div class="w-1/3 text-gray-600 font-semibold">Kelompok Makanan:</div>
            <div class="w-2/3 text-gray-800">{{ $clean_food->foodGroup->group ?? '-' }}</div>
        </div>
    </div>

    <!-- Baris 2 -->
    <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2">
        <div class="flex items-center">
            <div class="w-1/3 text-gray-600 font-semibold">Jenis Makanan:</div>
            <div class="w-2/3 text-gray-800">{{ $clean_food->foodType->type ?? '-' }}</div>
        </div>
        <div class="flex items-center">
            <div class="w-1/3 text-gray-600 font-semibold">Kalori (kcal):</div>
            <div class="w-2/3 text-gray-800">{{ $clean_food->calorie ?? '-' }}</div>
        </div>
    </div>

    <!-- Baris 3 -->
    <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2">
        <div class="flex items-center">
            <div class="w-1/3 text-gray-600 font-semibold">Protein (g):</div>
            <div class="w-2/3 text-gray-800">{{ $clean_food->protein ?? '-' }}</div>
        </div>
        <div class="flex items-center">
            <div class="w-1/3 text-gray-600 font-semibold">Lemak (g):</div>
            <div class="w-2/3 text-gray-800">{{ $clean_food->fats ?? '-' }}</div>
        </div>
    </div>

    <!-- Baris 4 -->
    <div class="grid grid-cols-1 gap-6 mb-6 md:grid-cols-2">
        <div class="flex items-center">
            <div class="w-1/3 text-gray-600 font-semibold">Karbohidrat (g):</div>
            <div class="w-2/3 text-gray-800">{{ $clean_food->carbs ?? '-' }}</div>
        </div>
        <div class="flex items-center">
            <div class="w-1/3 text-gray-600 font-semibold">Serat (g):</div>
            <div class="w-2/3 text-gray-800">{{ $clean_food->fiber ?? '-' }}</div>
        </div>
    </div>
 <!-- Tombol Aksi -->
 <div class="flex justify-end gap-4">
  <x-secondary-button>
      <a href="{{ route('admin.clean-food.index') }}">Kembali</a>
  </x-secondary-button>
</div>

  
</div>
        </div>
    </div>


@endsection
