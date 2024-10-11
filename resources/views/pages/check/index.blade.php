@extends('layouts.app')

@section('title','Meal Plan')

@section('content')
@php
$rekomendasiMakanan = [
    'Monday' => [
        'Sarapan' => ['Oatmeal dengan buah-buahan', 'Karbohidrat: Oatmeal', 'Lauk: N/A', 'Sayur: N/A', 'Buah: Buah-buahan'],
        'Makan Siang' => ['Salad sayuran dengan protein', 'Karbohidrat: N/A', 'Lauk: Ayam', 'Sayur: Salad', 'Buah: N/A'],
        'Makan Malam' => ['Ikan panggang dengan sayur', 'Karbohidrat: N/A', 'Lauk: Ikan', 'Sayur: Sayuran panggang', 'Buah: N/A']
    ],
    'Tuesday' => [
        'Sarapan' => ['Yogurt dengan granola', 'Karbohidrat: Granola', 'Lauk: N/A', 'Sayur: N/A', 'Buah: Buah segar'],
        'Makan Siang' => ['Ayam bakar dengan sayur kukus', 'Karbohidrat: N/A', 'Lauk: Ayam', 'Sayur: Sayuran kukus', 'Buah: N/A'],
        'Makan Malam' => ['Sup sayuran dengan roti gandum', 'Karbohidrat: Roti', 'Lauk: N/A', 'Sayur: Sup sayuran', 'Buah: N/A']
    ],
    'Wednesday' => [
        'Sarapan' => ['Smoothie hijau', 'Karbohidrat: N/A', 'Lauk: N/A', 'Sayur: Bayam', 'Buah: Pisang'],
        'Makan Siang' => ['Salad quinoa', 'Karbohidrat: Quinoa', 'Lauk: N/A', 'Sayur: Sayuran segar', 'Buah: N/A'],
        'Makan Malam' => ['Daging sapi panggang dengan ubi', 'Karbohidrat: Ubi', 'Lauk: Daging sapi', 'Sayur: N/A', 'Buah: N/A']
    ],
    'Thursday' => [
        'Sarapan' => ['Pancake gandum', 'Karbohidrat: Pancake', 'Lauk: N/A', 'Sayur: N/A', 'Buah: N/A'],
        'Makan Siang' => ['Sup ayam rendah lemak', 'Karbohidrat: N/A', 'Lauk: Ayam', 'Sayur: Sayuran', 'Buah: N/A'],
        'Makan Malam' => ['Ikan salmon dengan asparagus', 'Karbohidrat: N/A', 'Lauk: Ikan', 'Sayur: Asparagus', 'Buah: N/A']
    ],
    'Friday' => [
        'Sarapan' => ['Buah-buahan segar', 'Karbohidrat: N/A', 'Lauk: N/A', 'Sayur: N/A', 'Buah: Buah-buahan'],
        'Makan Siang' => ['Tahu tempe bakar', 'Karbohidrat: N/A', 'Lauk: Tahu/Tempe', 'Sayur: N/A', 'Buah: N/A'],
        'Makan Malam' => ['Nasi merah dengan ayam kukus', 'Karbohidrat: Nasi merah', 'Lauk: Ayam', 'Sayur: N/A', 'Buah: N/A']
    ],
    'Saturday' => [
        'Sarapan' => ['Roti gandum dengan telur', 'Karbohidrat: Roti gandum', 'Lauk: Telur', 'Sayur: N/A', 'Buah: N/A'],
        'Makan Siang' => ['Sup sayuran', 'Karbohidrat: N/A', 'Lauk: N/A', 'Sayur: Sayuran', 'Buah: N/A'],
        'Makan Malam' => ['Ayam panggang dengan kentang', 'Karbohidrat: Kentang', 'Lauk: Ayam', 'Sayur: N/A', 'Buah: N/A']
    ],
    'Sunday' => [
        'Sarapan' => ['Omelette sayur', 'Karbohidrat: N/A', 'Lauk: Telur', 'Sayur: Sayuran', 'Buah: N/A'],
        'Makan Siang' => ['Tumis sayur dengan tahu', 'Karbohidrat: N/A', 'Lauk: Tahu', 'Sayur: Sayuran', 'Buah: N/A'],
        'Makan Malam' => ['Steak dengan sayuran kukus', 'Karbohidrat: N/A', 'Lauk: Steak', 'Sayur: Sayuran kukus', 'Buah: N/A']
    ],
];

// Mendapatkan hari yang dipilih dari query string
$selectedDay = request('day', now()->locale('id')->format('l')); // Menggunakan locale 'id' untuk bahasa Indonesia
$days = array_keys($rekomendasiMakanan);
$currentDayIndex = array_search($selectedDay, $days);
$prevDay = $days[($currentDayIndex - 1 + count($days)) % count($days)];
$nextDay = $days[($currentDayIndex + 1) % count($days)];
@endphp
<section class="bg-white dark:bg-gray-0">
    <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16">
        <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl text-dark">Meal Plan</h1>

        {{-- jika data kosong --}}
        @if ($check->isEmpty())
            <p class="mb-8 text-lg font-normal text-black lg:text-xl sm:px-16 lg:px-48 dark:text-black">Belum ada meal plan yang dibuat. Ayo buat sekarang!</p>
            <div class="flex justify-center pb-[22rem]">
                <a href="{{ route('check.create') }}" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Buat Meal Plan</a>
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

        <div class="w-full flex justify-center gap-5 flex-wrap text-left">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="p-6 bg-gray-100 dark:bg-gray-800 rounded-lg shadow-lg">
                    <h3 class="text-xl font-bold mb-4">Sarapan</h3>
                    <ul class="list-disc list-inside">
                        @foreach ($rekomendasiMakanan[$selectedDay]['Sarapan'] as $detail)
                            <li class="text-gray-900 dark:text-gray-100">{{ $detail }}</li>
                        @endforeach
                    </ul>
                </div>

                <div class="p-6 bg-gray-100 dark:bg-gray-800 rounded-lg shadow-lg">
                    <h3 class="text-xl font-bold mb-4">Makan Siang</h3>
                    <ul class="list-disc list-inside">
                        @foreach ($rekomendasiMakanan[$selectedDay]['Makan Siang'] as $detail)
                            <li class="text-gray-900 dark:text-gray-100">{{ $detail }}</li>
                        @endforeach
                    </ul>
                </div>

                <div class="p-6 bg-gray-100 dark:bg-gray-800 rounded-lg shadow-lg">
                    <h3 class="text-xl font-bold mb-4">Makan Malam</h3>
                    <ul class="list-disc list-inside">
                        @foreach ($rekomendasiMakanan[$selectedDay]['Makan Malam'] as $detail)
                            <li class="text-gray-900 dark:text-gray-100">{{ $detail }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        @foreach ($check as $data)
        <div class="mb-5 mt-10">
            <a href="{{ route('check.edit', $data->id) }}" class="me-1 text-yellow-400 hover:underline">Ubah data</a>

            <form action="{{ route('history.store') }}" method="POST">
                @csrf
                <input type="hidden" name="check_id" value="{{ $data->id }}">
                <button type="submit" class="text-yellow-900 hover:underline">Tambah ke Histori</button>
            </form>


            <form action="{{ route('check.destroy', $data->id) }}" method="post" class="inline">
                @method('delete')
                @csrf
                <button type="submit" class="ms-1 text-red-600 hover:underline">
                    Hapus
                </button>
            </form>
        </div>
        @endforeach
        @endif
    </div>
</section>

<!-- Section for Tips Below -->
<div class="flex justify-center bg-gray-900 dark:bg-gray-900 py-8">
    <div class="mx-auto max-w-screen-lg px-4">
        <h2 class="text-3xl font-extrabold mb-6 text-center text-gray-900 dark:text-white">Tips untuk Anda</h2>

        <!-- Loop through the data for tips -->
        {{-- @foreach ($data as $item)
            @if ($item->status == 'Normal')
            <div class="mb-6">
                <h3 class="text-2xl font-bold text-green-500">Tubuh Anda Ideal!</h3>
                <ul class="list-disc list-inside text-gray-100 dark:text-gray-100">
                    @foreach ($item->news as $news)
                    <li>
                        <a href="{{ $news->link }}" target="_blank" class="text-blue-600 dark:text-blue-400 hover:underline">
                            {{ $news->title }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
            @else
            <div class="mb-6">
                <ul class="list-disc list-inside text-gray-700 dark:text-gray-300">
                    @foreach ($item->news as $news)
                    <li>
                        <a href="{{ $news->link }}" target="_blank" class="text-blue-600 dark:text-blue-400 hover:underline">
                            {{ $news->title }}
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
            @endif
        @endforeach
    </div> --}}
</div>
@endsection
