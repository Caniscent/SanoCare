@extends('layouts.app')

@section('title','Buat Meal Plan')

@section('content')
<section class="">
    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 grid lg:grid-cols-2 gap-8 lg:gap-16">
        <div class="flex flex-col justify-center">
            <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-black md:text-5xl lg:text-6xl dark:text-black">Meal Plan</h1>
            <p class="mb-6 text-lg font-normal text-black lg:text-xl dark:text-black">
                Isikan tinggi badan, berat badan, jenis aktivitas, dan kadar gula anda untuk mendapatkan
                meal plan selama 7 hari ke depan yang berisi makanan makanan sehat guna mencegah anda dari penyakit diabetes.
            </p>
        </div>
        <div>
            <div class="w-full lg:max-w-xl p-6 space-y-8 sm:p-8 bg-white rounded-lg shadow-xl dark:bg-gray-50">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-dark text-center">
                    Buat Meal Plan
                </h2>
                <form class="max-w-sm mx-auto" method="POST" action="{{ route('check.store') }}" enctype="multipart/form-data">
                    @csrf
                    {{-- height input --}}
                    <div class="mb-5">
                        <label for="height" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Tinggi</label>
                        <input type="number" name="height" id="height" class="bg-gray-50 no-spinners border @error('height') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-blue-200 dark:border-blue-100 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                        @error('height')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- weight input --}}
                    <div class="mb-5">
                        <label for="weight" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Berat</label>
                        <input type="number" name="weight" id="weight" class="bg-gray-50 no-spinners border @error('weight') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-blue-200 dark:border-blue-100 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                        @error('weight')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- activity input --}}
                    <div class="mb-5">
                        <label for="activity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Tingkat Aktivitas</label>
                        <select id="activity" class="input input-bordered w-full @error('activity') input-error @enderror bg-blue-200 text-black" name="activity" required>
                            @foreach ( as )
                                <option value="" disabled selected>{{ __('Pilih Tingkat Aktivitas') }}</option>
                                <option value="ringan" {{ old('activity') == 'ringan' ? 'selected' : '' }}>Ringan</option>
                                <option value="sedang" {{ old('activity') == 'sedang' ? 'selected' : '' }}>Sedang</option>
                                <option value="berat" {{ old('activity') == 'berat' ? 'selected' : '' }}>Berat</option>
                            @endforeach
                        </select>
                        @error('activity')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- sugar level input --}}
                    <div class="mb-5">
                        <label for="sugar" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Kadar Gula</label>
                        <div class="relative">
                            <input type="number" name="sugar" id="sugar" class="bg-gray-50 no-spinners border @error('sugar') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 pr-20 dark:bg-blue-200 dark:border-blue-100 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                            <span class="absolute right-3 top-2 text-sm text-dark dark:text-gray-900">mg/dL</span>
                        </div>
                        @error('sugar')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- uji input --}}
                    <div class="mb-5">
                        <label for="test_method" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Metode Uji</label>
                        <select id="test_method" class="input input-bordered w-full @error('test_method') input-error @enderror bg-blue-200 text-black" name="test_method" required>
                            <option value="" disabled selected>{{ __('Pilih Metode Uji') }}</option>
                            <option value="puasa" {{ old('test_method') == 'puasa' ? 'selected' : '' }}>Puasa</option>
                            <option value="ttgo" {{ old('test_method') == 'ttgo' ? 'selected' : '' }}>TTGO</option>
                        </select>
                        @error('test_method')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                        @enderror
                    </div>


                    <button type="submit" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Buat
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
