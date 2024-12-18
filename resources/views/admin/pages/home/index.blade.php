@extends('admin.layouts.app')

@section('title', 'Beranda')

@section('content')
<div class="overflow-x-auto">
    <h3 class="mt-12 mb-4 text-2xl font-bold">Selamat Datang, Admin!</h3>
    <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-2 lg:grid-cols-4">
        <!-- Card for Jumlah Artikel Publish -->
        <div class="flex items-center p-4 text-white bg-blue-500 rounded-lg shadow-md">
            <div class="mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" fill="white" stroke-width="2" stroke="currentColor" class="w-10 h-10">
                    <path d="M96 96c0-35.3 28.7-64 64-64l288 0c35.3 0 64 28.7 64 64l0 320c0 35.3-28.7 64-64 64L80 480c-44.2 0-80-35.8-80-80L0 128c0-17.7 14.3-32 32-32s32 14.3 32 32l0 272c0 8.8 7.2 16 16 16s16-7.2 16-16L96 96zm64 24l0 80c0 13.3 10.7 24 24 24l112 0c13.3 0 24-10.7 24-24l0-80c0-13.3-10.7-24-24-24L184 96c-13.3 0-24 10.7-24 24zm208-8c0 8.8 7.2 16 16 16l48 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-48 0c-8.8 0-16 7.2-16 16zm0 96c0 8.8 7.2 16 16 16l48 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-48 0c-8.8 0-16 7.2-16 16zM160 304c0 8.8 7.2 16 16 16l256 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-256 0c-8.8 0-16 7.2-16 16zm0 96c0 8.8 7.2 16 16 16l256 0c8.8 0 16-7.2 16-16s-7.2-16-16-16l-256 0c-8.8 0-16 7.2-16 16z"/>
                 </svg>
            </div>
            <div>
                <h4 class="text-lg font-semibold">Artikel</h4>
                <p class="text-xl font-bold">{{$article}}</p>
            </div>
        </div>

        <!-- Card for Pilihan -->
        <div class="flex items-center p-4 text-white bg-green-500 rounded-lg shadow-md">
            <div class="mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" fill="white" stroke-width="2" stroke="currentColor" class="w-10 h-10">
                    <path d="M416 0C400 0 288 32 288 176l0 112c0 35.3 28.7 64 64 64l32 0 0 128c0 17.7 14.3 32 32 32s32-14.3 32-32l0-128 0-112 0-208c0-17.7-14.3-32-32-32zM64 16C64 7.8 57.9 1 49.7 .1S34.2 4.6 32.4 12.5L2.1 148.8C.7 155.1 0 161.5 0 167.9c0 45.9 35.1 83.6 80 87.7L80 480c0 17.7 14.3 32 32 32s32-14.3 32-32l0-224.4c44.9-4.1 80-41.8 80-87.7c0-6.4-.7-12.8-2.1-19.1L191.6 12.5c-1.8-8-9.3-13.3-17.4-12.4S160 7.8 160 16l0 134.2c0 5.4-4.4 9.8-9.8 9.8c-5.1 0-9.3-3.9-9.8-9L127.9 14.6C127.2 6.3 120.3 0 112 0s-15.2 6.3-15.9 14.6L83.7 151c-.5 5.1-4.7 9-9.8 9c-5.4 0-9.8-4.4-9.8-9.8L64 16zm48.3 152l-.3 0-.3 0 .3-.7 .3 .7z"/>
                </svg>
            </div>
            <div>
                <h4 class="text-lg font-semibold">Pilihan Makanan</h4>
                <p class="text-xl font-bold">{{$food}}</p>
            </div>
        </div>

        <!-- Card for Tipe -->
        <div class="flex items-center p-4 text-white bg-yellow-500 rounded-lg shadow-md">
            <div class="mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"   fill="white" stroke-width="2" stroke="currentColor" class="w-10 h-10">
                    <path d="M0 192c0-35.3 28.7-64 64-64c.5 0 1.1 0 1.6 0C73 91.5 105.3 64 144 64c15 0 29 4.1 40.9 11.2C198.2 49.6 225.1 32 256 32s57.8 17.6 71.1
                     43.2C339 68.1 353 64 368 64c38.7 0 71 27.5 78.4 64c.5 0 1.1 0 1.6 0c35.3 0 64 28.7 64 64c0 11.7-3.1 22.6-8.6 32L8.6 224C3.1
                     214.6 0 203.7 0 192zm0 91.4C0 268.3 12.3 256 27.4 256l457.1 0c15.1 0 27.4 12.3 27.4 27.4c0 70.5-44.4 130.7-106.7 154.1L403.5
                     452c-2 16-15.6 28-31.8 28l-231.5 0c-16.1 0-29.8-12-31.8-28l-1.8-14.4C44.4 414.1 0 353.9 0 283.4z"/></svg>
            </div>
            <div>
                    <h4 class="text-lg font-semibold">Jenis Makanan</h4>
                <p class="text-xl font-bold">{{$group}}</p>
            </div>
        </div>

        <!-- Card for Kelompok Makanan -->
        <div class="flex items-center p-4 text-white bg-red-500 rounded-lg shadow-md">
            <div class="mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" fill="white" stroke-width="2" stroke="currentColor" class="w-10 h-10">
                    <path d="M345.7 48.3L358 34.5c5.4-6.1 13.3-8.8 20.9-8.9c7.2 0 14.3 2.6 19.9 7.8c19.7 18.3 39.8 43.2 55 70.6C469 131.2 480 162.2 480 192.2C480 280.8 408.7 352 320 352c-89.6 0-160-71.3-160-159.8c0-37.3 16-73.4 36.8-104.5c20.9-31.3 47.5-59 70.9-80.2C273.4 2.3 280.7-.2 288 0c14.1 .3 23.8 11.4 32.7 21.6c0 0 0 0 0 0c2 2.3 4 4.6 6 6.7l19 19.9zM384 240.2c0-36.5-37-73-54.8-88.4c-5.4-4.7-13.1-4.7-18.5 0C293 167.1 256 203.6 256 240.2c0 35.3 28.7 64 64 64s64-28.7 64-64zM32 288c0-17.7 14.3-32 32-32l32 0c17.7 0 32 14.3 32 32s-14.3 32-32 32l0 64 448 0 0-64c-17.7 0-32-14.3-32-32s14.3-32 32-32l32 0c17.7 0 32 14.3 32 32l0 96c17.7 0 32 14.3 32 32l0 64c0 17.7-14.3 32-32 32L32 512c-17.7 0-32-14.3-32-32l0-64c0-17.7 14.3-32 32-32l0-96zM320 480a32 32 0 1 0 0-64 32 32 0 1 0 0 64zm160-32a32 32 0 1 0 -64 0 32 32 0 1 0 64 0zM192 480a32 32 0 1 0 0-64 32 32 0 1 0 0 64z"/>
                    </svg>
            </div>
            <div>
                <h4 class="text-lg font-semibold">Tipe Makanan</h4>
                <p class="text-xl font-bold">{{$type}}</p>
            </div>
        </div>
    </div>
    <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
        <!-- Line Chart -->
        <div class="p-4 bg-white rounded-lg shadow">
            <canvas id="lineChart"></canvas>
        </div>

        <!-- Bar Chart -->
        <div class="p-4 bg-white rounded-lg shadow">
            <canvas id="barChart" width="400" height="200"></canvas>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </div>
</div>
</div>

@endsection
