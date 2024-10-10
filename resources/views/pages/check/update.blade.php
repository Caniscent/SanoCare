@extends('layouts.app')

@section('title','Perbarui Meal Plan')

@section('content')
<section class="">
    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 grid lg:grid-cols-2 gap-8 lg:gap-16" style="background-image: url('{{asset('img/buddha-bowl-dish-with-vegetables-legumes-top-view.jpg')}}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
        <div class="flex flex-col justify-center">
            <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-black md:text-5xl lg:text-6xl dark:text-black">Meal Plan</h1>
            <p class="mb-6 text-lg font-normal text-black lg:text-xl dark:text-black">
                Isikan data tinggi badan, berat badan, jenis aktivitas, kadar gula, dan metode uji anda untuk mendapatkan
                meal plan selama 7 hari ke depan yang berisi makanan makanan sehat guna mencegah anda dari penyakit diabetes.
            </p>
        </div>
        <div>
            <div class="w-full lg:max-w-xl p-6 space-y-8 sm:p-8 bg-white rounded-lg shadow-xl dark:bg-gray-800">
                <h2 class="text-2xl font-bold text-gray-900 dark:text-white">
                    Perbarui Data
                </h2>

                <form class="max-w-sm mx-auto" method="POST" action="{{ route('check.update', $check['id']) }}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf

                    <div class="mb-5">
                        <label for="height" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tinggi</label>
                        <input type="number" name="height" id="height" value="{{$check['height']}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                        @error('height')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-5">
                        <label for="weight" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Berat</label>
                        <input type="number" name="weight" id="weight" value="{{$check['weight']}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                        @error('weight')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Perbarui
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection
