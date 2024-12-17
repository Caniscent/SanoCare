{{-- <footer class="flex flex-wrap items-center justify-between w-full px-4 py-4 bg-white shadow">
 <div class="container mx-auto text-center">
     <p>&copy; {{ date('Y') }} Your Company Name. All rights reserved.</p>
     <p>Designed with ❤️ by Your Team.</p>
 </div>
</footer> --}}
<script>
 document.querySelectorAll('.delete-button').forEach((button) => {
     button.addEventListener('click', function (event) {
         event.preventDefault(); // Mencegah form submit langsung
         const formId = 'delete-form-' + button.getAttribute('data-id');
         Swal.fire({
             title: 'Apakah Anda yakin?',
             text: 'Data ini akan dihapus dan tidak bisa dikembalikan.',
             icon: 'warning',
             showCancelButton: true,
             confirmButtonText: 'Ya, hapus!',
             cancelButtonText: 'Batal',
             reverseButtons: true
         }).then((result) => {
             if (result.isConfirmed) {
                 // Jika dikonfirmasi, kirimkan form
                 document.getElementById(formId).submit();
             }
         });
     });
 });
</script>
@if(session('success'))
<script>
 Swal.fire({
     icon: 'success',
     title: 'Sukses!',
     text: '{{ session('success') }}',
     timer: 2000, // durasi alert ditampilkan
     showConfirmButton: false
 });
</script>
@endif
<script src="https://code.jquery.com/jquery-3.7.1.min.js"
integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
<script>
$(document).ready(function() {
    $('#Table').DataTable({
        responsive: true,
        autoWidth: false,
        scrollX: true,
    });
});
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
    const barCtx = document.getElementById('barChart').getContext('2d');
    fetch('/admin/articles-by-month')
        .then(response => response.json())
        .then(data => {
            const labels = data.map(item => item.month);
            const counts = data.map(item => item.count);
            const barChart = new Chart(barCtx, {
                type: 'bar',
                data: {
                    labels: labels,
                    datasets: [{
                        label: 'Artikel Dipublikasikan',
                        data: counts,
                        backgroundColor: 'rgb(75, 192, 192)',
                    }]
                },
                options: {
                    responsive: true,
                }
            });
        })
        .catch(error => console.error('Error fetching data:', error));
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    const lineCtx = document.getElementById('lineChart').getContext('2d');
    fetch('/admin/log-by-month')
        .then(response => response.json())
        .then(data =>{
            const labels = data.map(item => item.month);
            const counts = data.map(item => item.count);
            const lineChart = new Chart(lineCtx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'User Meal Plan',
                    data: counts,
                    borderColor: 'rgb(54, 162, 235)',
                    tension: 0.4
                }]
            },
            options: {
                responsive: true
            }
            });
        })
        .catch(error => console.error('Error fetching data:', error));
});




</script>
