@extends('admin.layouts.app')

@section('title', 'Beranda')

@section('content')
<div class="overflow-x-auto">
    <h3 class="text-2xl font-bold mb-4">Selamat Datang, Admin!</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Line Chart -->
        <div class="bg-white shadow rounded-lg p-4">
            <canvas id="lineChart"></canvas>
        </div>

        <!-- Bar Chart -->
        <div class="bg-white shadow rounded-lg p-4">
            <canvas id="barChart"></canvas>
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
        const barCtx = document.getElementById('barChart').getContext('2d');
        const barChart = new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun'],
                datasets: [{
                    label: 'Artikel Dipublikasikan',
                    data: [5, 8, 6, 12, 10, 15],
                    backgroundColor: 'rgb(75, 192, 192)'
                }]
            },
            options: {
                responsive: true
            }
        });
    </script>



    </div>
</div>
</div>

@endsection
