@extends('layouts.app')

@section('title', 'Meal Plan')

@section('content')
<section class="bg-white dark:bg-gray-0">
    <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16">
        <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl">Rencana Makan</h1>

        @if ($measurements->isEmpty())
            <p class="mb-8 text-lg font-normal text-black lg:text-xl sm:px-16 lg:px-48 dark:text-black">Belum ada meal plan yang dibuat. Ayo buat sekarang!</p>
            <div class="flex justify-center pb-[22rem]">
                <a href="{{ route('meal-plan.create') }}" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Buat Meal Plan</a>
            </div>
        @else
        @foreach ($measurements as $data)
            <p class="text-gray-900 my-20 mx-auto text-center max-w-2xl">
                Hai {{$data->user->name}}, kamu memiliki tinggi badan <b>{{$data->height}} cm</b> dan berat badan <b>{{$data->weight}} kg</b>.
                Kegiatan fisik yang kamu lakukan adalah <b>{{$data->activityLevel->level}}</b> dan kandungan gula dalam darah sebesar <b>{{$data->sugar_blood}} mg/dL</b> ({{$data->testMethod->method}}).
                Dan dengan mempertimbangkan dirimu yang seorang <b>{{$data->user->gender}}</b> dan berumur <b>{{$data->user->age}} tahun</b>, maka berikut ini adalah <b>meal plan</b> yang kami buat khusus untukmu.
            </p>
        @endforeach


            <div class="flex justify-between mb-10">
                <a href="?day={{ $prevDay }}" class="btn btn-primary bg-blue-500 hover:bg-blue-600 text-white">&lt; {{ \Carbon\Carbon::parse($prevDay)->locale('id')->isoFormat('dddd') }}</a>
                <span class="text-xl font-bold text-gray-900">{{ \Carbon\Carbon::parse($selectedDay)->locale('id')->isoFormat('dddd') }}</span>
                <a href="?day={{ $nextDay }}" class="btn btn-primary bg-blue-500 hover:bg-blue-600 text-white">{{ \Carbon\Carbon::parse($nextDay)->locale('id')->isoFormat('dddd') }} &gt;</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="p-6 bg-gray-100 dark:bg-green-300 rounded-lg shadow-lg">
                    <h3 class="text-xl font-bold mb-4 text-gray-900">Sarapan</h3>
                    <ul class="list-disc list-inside">
                        @if (!empty($mealPlan[$selectedDay]['breakfast']))
                            @foreach ($mealPlan[$selectedDay]['breakfast'] as $detail)
                                <li class="flex items-center text-gray-900 dark:text-gray-900 mb-2">
                                    @if ($detail['food_group'] == 10)
                                        <img src="{{ asset('img/icons/bowl-rice-solid.svg') }}" alt="Karbohidrat" class="w-6 h-6 mr-2">
                                    @elseif ($detail['food_group'] == 4)
                                        <img src="{{ asset('img/icons/drumstick-bite-solid.svg') }}" alt="Protein Hewan" class="w-6 h-6 mr-2">
                                    @elseif ($detail['food_group'] == 9)
                                        <img src="{{ asset('img/icons/carrot-solid.svg') }}" alt="Sayuran" class="w-6 h-6 mr-2">
                                    @elseif ($detail['food_group'] == 1)
                                        <img src="{{ asset('img/icons/seedling-solid.svg') }}" alt="Protein Nabati" class="w-6 h-6 mr-2">
                                    @elseif ($detail['food_group'] == 2)
                                        <img src="{{ asset('img/icons/apple-whole-solid.svg') }}" alt="Buah" class="w-6 h-6 mr-2">
                                    @endif

                                    <span class="flex-1 text-left" title="{{ $detail['food_name'] }}">
                                        {{ $detail['food_name'] }}
                                    </span>
                                    <span class="text-sm ml-4">{{ $detail['portion'] }} ({{ $detail['calories'] }} kalori)</span>
                                </li>
                            @endforeach
                        @else
                            <li class="text-gray-900 dark:text-gray-900">Data tidak tersedia untuk Sarapan.</li>
                        @endif
                    </ul>
                </div>

                <div class="p-6 bg-gray-100 dark:bg-yellow-200 rounded-lg shadow-lg">
                    <h3 class="text-xl font-bold mb-4 text-gray-900">Makan Siang</h3>
                    <ul class="list-disc list-inside">
                        @if (!empty($mealPlan[$selectedDay]['lunch']))
                            @foreach ($mealPlan[$selectedDay]['lunch'] as $detail)
                                <li class="flex items-center text-gray-900 dark:text-gray-900 mb-2">
                                    @if ($detail['food_group'] == 10)
                                        <img src="{{ asset('img/icons/bowl-rice-solid.svg') }}" alt="Karbohidrat" class="w-6 h-6 mr-2">
                                    @elseif ($detail['food_group'] == 4)
                                        <img src="{{ asset('img/icons/drumstick-bite-solid.svg') }}" alt="Protein Hewan" class="w-6 h-6 mr-2">
                                    @elseif ($detail['food_group'] == 9)
                                        <img src="{{ asset('img/icons/carrot-solid.svg') }}" alt="Sayuran" class="w-6 h-6 mr-2">
                                    @elseif ($detail['food_group'] == 1)
                                        <img src="{{ asset('img/icons/seedling-solid.svg') }}" alt="Protein Nabati" class="w-6 h-6 mr-2">
                                    @elseif ($detail['food_group'] == 2)
                                        <img src="{{ asset('img/icons/apple-whole-solid.svg') }}" alt="Buah" class="w-6 h-6 mr-2">
                                    @endif

                                    <span class="flex-1 text-left" title="{{ $detail['food_name'] }}">
                                        {{ $detail['food_name'] }}
                                    </span>
                                    <span class="text-sm ml-4">{{ $detail['portion'] }} ({{ $detail['calories'] }} kalori)</span>
                                </li>
                            @endforeach
                        @else
                            <li class="text-gray-900 dark:text-gray-900">Data tidak tersedia untuk Makan Siang.</li>
                        @endif
                    </ul>
                </div>

                <div class="p-6 bg-gray-100 dark:bg-blue-300 rounded-lg shadow-lg">
                    <h3 class="text-xl font-bold mb-4 text-gray-900">Makan Malam</h3>
                    <ul class="list-disc list-inside">
                        @if (!empty($mealPlan[$selectedDay]['dinner']))
                            @foreach ($mealPlan[$selectedDay]['dinner'] as $detail)
                                <li class="flex items-center text-gray-900 dark:text-gray-900 mb-2">
                                    @if ($detail['food_group'] == 10)
                                        <img src="{{ asset('img/icons/bowl-rice-solid.svg') }}" alt="Karbohidrat" class="w-6 h-6 mr-2">
                                    @elseif ($detail['food_group'] == 4)
                                        <img src="{{ asset('img/icons/drumstick-bite-solid.svg') }}" alt="Protein Hewan" class="w-6 h-6 mr-2">
                                    @elseif ($detail['food_group'] == 9)
                                        <img src="{{ asset('img/icons/carrot-solid.svg') }}" alt="Sayuran" class="w-6 h-6 mr-2">
                                    @elseif ($detail['food_group'] == 1)
                                        <img src="{{ asset('img/icons/seedling-solid.svg') }}" alt="Protein Nabati" class="w-6 h-6 mr-2">
                                    @elseif ($detail['food_group'] == 2)
                                        <img src="{{ asset('img/icons/apple-whole-solid.svg') }}" alt="Buah" class="w-6 h-6 mr-2">
                                    @endif

                                    <span class="flex-1 text-left" title="{{ $detail['food_name'] }}">
                                        {{ $detail['food_name'] }}
                                    </span>
                                    <span class="text-sm ml-4">{{ $detail['portion'] }} ({{ $detail['calories'] }} kalori)</span>
                                </li>
                            @endforeach
                        @else
                            <li class="text-gray-900 dark:text-gray-900">Data tidak tersedia untuk Makan Malam.</li>
                        @endif
                    </ul>
                </div>
            </div>



            @foreach ($measurements as $data)
            <div class="mb-5 mt-10">
                {{-- update --}}
                <a href="{{ route('meal-plan.edit', $data->id) }}" class="me-1 text-yellow-400 hover:underline">Ubah data</a>

                {{-- delete --}}
                <button type="button" id="openDeleteModal" class="ms-1 text-red-600 hover:underline">
                    Hapus
                </button>

                <input type="checkbox" id="delete-confirm-modal" class="modal-toggle" />
                <div class="modal">
                    <div class="modal-box bg-gray-900">
                        <h3 class="font-bold text-lg text-white">Konfirmasi Penghapusan Meal Plan</h3>
                        <p class="text-white">Tindakan anda sekarang akan menghapus seluruh meal plan, apakah anda ingin melanjutkan?</p>
                        <div class="modal-action justify-center">
                            <label for="delete-confirm-modal" class="btn bg-gray-400 hover:bg-gray-500 text-gray-900">Tidak</label>
                            <button id="confirmDeleteButton" class="btn btn-error">Ya, Lanjutkan</button>
                        </div>
                    </div>
                </div>

                <form action="{{ route('meal-plan.destroy', $data->id) }}" id="deleteForm" method="post" class="inline">
                    @method('delete')
                    @csrf
                </form>
            </div>
            @endforeach
        @endif
    </div>
</section>

{{-- <div class="flex justify-center bg-gray-900 dark:bg-gray-900 py-8">
    <div class="mx-auto max-w-screen-lg px-4">
        <h2 class="text-3xl font-extrabold mb-6 text-center text-gray-900 dark:text-white">Tips untuk Anda</h2>

    </div>
</div> --}}

<script>
    // Ketika tombol Hapus diklik, buka modal konfirmasi
    document.getElementById('openDeleteModal').addEventListener('click', function() {
        document.getElementById('delete-confirm-modal').checked = true;
    });

    // Submit form penghapusan
    document.getElementById('confirmDeleteButton').addEventListener('click', function() {
        document.getElementById('deleteForm').submit();
    });
</script>
@endsection
