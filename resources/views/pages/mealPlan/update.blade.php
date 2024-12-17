@extends('layouts.app')

@section('title','Perbarui Meal Plan')

@section('content')
<section class="min-h-screen" style="background-image: url('{{asset('img/buddha-bowl-dish-with-vegetables-legumes-top-view.jpg')}}'); background-size: cover; background-position: center; background-repeat: no-repeat;">
    <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 grid lg:grid-cols-2 gap-8 lg:gap-16" >
        <div class="flex flex-col justify-center">
            <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-black md:text-5xl lg:text-6xl !text-white">Meal Plan</h1>
            <p class="mb-6 text-lg font-normal !text-white lg:text-xl dark:text-black">
                Isikan data tinggi badan, berat badan, jenis aktivitas, kadar gula, dan metode uji anda untuk mendapatkan
                meal plan selama 7 hari ke depan yang berisi makanan makanan sehat guna mencegah anda dari penyakit diabetes.
            </p>
        </div>
        <div>
            <div class="w-full lg:max-w-xl p-6 space-y-8 sm:p-8 bg-white rounded-lg shadow-xl dark:bg-gray-50">
                <h2 class="text-2xl font-bold text-gray-900 text-dark">
                    Perbarui Data
                </h2>

                <form class="max-w-sm mx-auto" method="POST" action="{{ route('meal-plan.update', $measurement->id) }}" enctype="multipart/form-data" onsubmit="showLoadingScreen()">
                    @method('PUT')
                    @csrf

                    {{-- height input --}}
                    <div class="mb-5">
                        <label for="height" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Tinggi</label>
                        <input type="number" name="height" id="height" value="{{ old('height', $measurement->height) }}" class="bg-gray-50 no-spinners border @error('height') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 !bg-blue-200 dark:bg-blue-200 dark:border-blue-100 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                        @error('height')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- weight input --}}
                    <div class="mb-5">
                        <label for="weight" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Berat</label>
                        <input type="number" name="weight" id="weight" value="{{ old('weight', $measurement->weight) }}" class="bg-gray-50 no-spinners border @error('weight') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 !bg-blue-200 dark:bg-blue-200 dark:border-blue-100 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                        @error('weight')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- activity level input --}}
                    <div class="mb-5">
                        <label for="level" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Tingkat Aktivitas</label>
                        <select id="level" class="input input-bordered w-full @error('activity_categories_id') input-error @enderror bg-blue-200 text-black" name="level" required>
                            <option value="" disabled {{ old('activity_level_id', $measurement->activity_level_id) == '' ? 'selected' : '' }}>
                                Pilih Tingkat Aktivitas
                            </option>
                            @foreach ($activities as $activity)
                                <option value="{{ $activity->id }}" title="{{ $activity->description }}"
                                    {{ (old('activity_level_id', $measurement->activity_level_id) == $activity->id) ? 'selected' : '' }}>
                                    {{ $activity->level }}
                                </option>
                            @endforeach
                        </select>
                        @error('level')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                        @enderror
                    </div>


                    {{-- sugar level input --}}
                    <div class="mb-5">
                        <div class="flex items-center justify-between">
                            <label for="sugar_blood" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">
                                Kadar Gula
                            </label>
                            <div class="dropdown dropdown-end">
                                <div tabindex="0" role="button"><img src="{{ asset('img/icons/circle-info-solid.svg') }}" alt="Info" class="w-5 h-5 pb-1"></div>
                                <ul tabindex="0" class="dropdown-content menu bg-blue-500 dark:bg-blue-500 rounded-box z-[1] w-64 p-2 shadow text-white">
                                    <p>Untuk mengecek kadar gula darah, gunakan alat glucometer. Bersihkan ujung jari, tusuk dengan lancet, dan teteskan darah pada strip tes sesuai petunjuk alat.<br>Bisa juga kunjungi rumah sakit/puskesmas terdekat untuk melakukan pengecekan gula darah.</p>
                                </ul>
                            </div>
                        </div>

                        <div class="relative">
                            <input type="number" name="sugar_blood" id="sugar_blood" value="{{$measurement->sugar_blood }}" class="bg-gray-50 no-spinners border @error('sugar_blood') border-red-500 @else border-gray-300 @enderror text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 pr-20 !bg-blue-200 dark:bg-blue-200 dark:border-blue-100 dark:placeholder-gray-400 dark:text-dark dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
                            <span class="absolute right-3 top-2 text-sm text-dark dark:text-gray-900">mg/dL</span>
                        </div>

                        @error('sugar_blood')
                            <p class="mt-1 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
                        @enderror
                    </div>



                    {{-- metode uji input --}}
                    <div class="mb-5">
                        <label for="test_method" class="block mb-2 text-sm font-medium text-gray-900 dark:text-dark">Metode Uji</label>
                        <select id="test_method" class="input input-bordered w-full @error('test_method_id') input-error @enderror bg-blue-200 text-black" name="test_method" required>
                            <option value="" disabled {{ old('test_method_id', $measurement->test_method_id) == '' ? 'selected' : '' }}>
                                Pilih Metode Uji
                            </option>
                            @foreach ($test_methods as $method)
                                <option value="{{ $method->id }}" title="{{ $method->description }}"
                                    {{ (old('test_method_id', $measurement->test_method_id) == $method->id) ? 'selected' : '' }}>
                                    {{ $method->method }}
                                </option>
                            @endforeach
                        </select>
                        @error('test_method')
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
    <div id="loading-screen" class="fixed inset-0 flex flex-col items-center justify-center bg-gray-900 bg-opacity-50 z-50 hidden">
        <span class="loading loading-spinner loading-lg text-white mb-4"></span>
        <p class="text-white text-lg">Tunggu 30 detik, sistem sedang memproses...</p>
    </div>
</section>

<script>
    function showLoadingScreen() {
        document.getElementById('loading-screen').classList.remove('hidden');
    }

</script>
@endsection
