@extends('layouts.app')

@section('title', 'Meal Plan')

@section('content')
<section class="bg-white dark:bg-gray-0">
    <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16">
        <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl">Meal Plan</h1>

        @if ($check->isEmpty())
            <p class="mb-8 text-lg font-normal text-black lg:text-xl sm:px-16 lg:px-48 dark:text-black">Belum ada meal plan yang dibuat. Ayo buat sekarang!</p>
            <div class="flex justify-center pb-[22rem]">
                <a href="{{ route('check.create') }}" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2">Buat Meal Plan</a>
            </div>
        @else
            @foreach ($check as $data)
                <p class="text-gray-900 my-20 mx-60">Hai {{$data->user->name}}, kamu memiliki tinggi badan <b>{{$data->height}} cm</b> dan berat badan <b>{{$data->weight}} kg</b>.
                    Kegiatan fisik yang kamu lakukan adalah <b>{{$data->activityCategories->activity}}</b> dan kandungan gula dalam darah sebesar <b>{{$data->sugar_content}} mg/dL</b> ({{$data->testMethod->method}}).
                    Dan dengan mempertimbangkan dirimu yang seorang <b>{{$data->user->gender}}</b> dan berumur <b>{{$data->user->age}} tahun</b>, maka berikut ini adalah <b>meal plan</b> yang kami buatkan khusus untukmu.
                </p>
            @endforeach

            <div class="flex justify-between mb-10">
                <a href="?day={{ $prevDay }}" class="btn btn-primary bg-blue-500 hover:bg-blue-600">&lt; {{ $prevDay }}</a>
                <span class="text-xl font-bold text-gray-900">{{ $selectedDay }}</span>
                <a href="?day={{ $nextDay }}" class="btn btn-primary bg-blue-500 hover:bg-blue-600">{{ $nextDay }} &gt;</a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="p-6 bg-gray-100 dark:bg-gray-800 rounded-lg shadow-lg">
                    <h3 class="text-xl font-bold mb-4">Sarapan</h3>
                    <ul class="list-disc list-inside">
                        @if (!empty($mealPlan[$selectedDay]['breakfast']))
                            @foreach ($mealPlan[$selectedDay]['breakfast'] as $detail)
                                <li class="text-gray-900 dark:text-gray-100">{{ $detail['ingredients_name'] }}</li> <!-- Perubahan di sini -->
                            @endforeach
                        @else
                            <li class="text-gray-900 dark:text-gray-100">Data tidak tersedia untuk Sarapan.</li>
                        @endif
                    </ul>
                </div>

                <div class="p-6 bg-gray-100 dark:bg-gray-800 rounded-lg shadow-lg">
                    <h3 class="text-xl font-bold mb-4">Makan Siang</h3>
                    <ul class="list-disc list-inside">
                        @if (!empty($mealPlan[$selectedDay]['lunch']))
                            @foreach ($mealPlan[$selectedDay]['lunch'] as $detail)
                                <li class="text-gray-900 dark:text-gray-100">{{ $detail['ingredients_name'] }}</li> <!-- Perubahan di sini -->
                            @endforeach
                        @else
                            <li class="text-gray-900 dark:text-gray-100">Data tidak tersedia untuk Makan Siang.</li>
                        @endif
                    </ul>
                </div>

                <div class="p-6 bg-gray-100 dark:bg-gray-800 rounded-lg shadow-lg">
                    <h3 class="text-xl font-bold mb-4">Makan Malam</h3>
                    <ul class="list-disc list-inside">
                        @if (!empty($mealPlan[$selectedDay]['dinner']))
                            @foreach ($mealPlan[$selectedDay]['dinner'] as $detail)
                                <li class="text-gray-900 dark:text-gray-100">{{ $detail['ingredients_name'] }}</li> <!-- Perubahan di sini -->
                            @endforeach
                        @else
                            <li class="text-gray-900 dark:text-gray-100">Data tidak tersedia untuk Makan Malam.</li>
                        @endif
                    </ul>
                </div>
            </div>


            @foreach ($check as $data)
            <div class="mb-5 mt-10">
                <a href="{{ route('check.edit', $data->id) }}" class="me-1 text-yellow-400 hover:underline">Ubah data</a>

                <form action="{{ route('check.destroy', $data->id) }}" method="post" class="inline">
                    @method('delete')
                    @csrf
                    <button type="submit" class="ms-1 text-red-600 hover:underline">
                        Hapus
                    </button>
                </form>
                <form action="{{ route('history.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="check_id" value="{{ $data->id }}">
                    <button type="submit" class="text-yellow-900 hover:underline">Tambah ke Histori</button>
                </form>
            </div>
            @endforeach
        @endif
    </div>
</section>

<div class="flex justify-center bg-gray-900 dark:bg-gray-900 py-8">
    <div class="mx-auto max-w-screen-lg px-4">
        <h2 class="text-3xl font-extrabold mb-6 text-center text-gray-900 dark:text-white">Tips untuk Anda</h2>
        {{-- Tambahkan tips di sini jika diperlukan --}}
    </div>
</div>
@endsection
