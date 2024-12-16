@extends('admin.layouts.app')

@section('title', 'Beranda')

@section('content')
<div class="overflow-x-auto">
    <h3 class="mt-12 mb-4 text-2xl font-bold">Selamat Datang, Admin!</h3>
    <div class="grid grid-cols-1 gap-4 mb-4 md:grid-cols-2 lg:grid-cols-4">
        <!-- Card for Jumlah Artikel Publish -->
        <div class="flex items-center p-4 text-white bg-blue-500 rounded-lg shadow-md">
            <div class="mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-10 h-10">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 10h16M4 14h16M4 18h16" />
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
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-10 h-10">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
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
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-10 h-10">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 10h18M3 14h18M4 6h16M4 18h16" />
                </svg>
            </div>
            <div>
                    <h4 class="text-lg font-semibold">Jenis Makanan</h4>
                <p class="text-xl font-bold">{{$group}}</p>
            </div>
        </div>

        <!-- Card for Kelompok Makanan -->
        <div class="flex items-center p-4 text-white bg-red-500 rounded-lg shadow-md">
            <div class="mr-4">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" class="w-10 h-10">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6l4 4" />
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
    <script>
                // Line Chart
                const lineCtx = document.getElementById('lineChart').getContext('2d');
        const lineChart = new Chart(lineCtx, {
            type: 'line',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Pengunjung',
                    data: [10, 20, 15, 30, 25, 35],
                    borderColor: 'rgb(54, 162, 235)',
                    tension: 0.4
                }]
            },
            options: {
                responsive: true
            }
        });

        // Bar Chart
    </script>
   



    </div>
</div>
</div>

@endsection
