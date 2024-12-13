{{-- <footer class="flex flex-wrap items-center justify-between  bg-white px-4 py-4 shadow w-full">
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
        responsive: true, // Aktifkan fitur responsif
        autoWidth: false, // Agar kolom tidak terlalu lebar
        scrollX: true, // Aktifkan scrolling horizontal
    });
});

</script>