// Fungsi SweetAlert untuk konfirmasi penghapusan
function confirmDeletion(buttonSelector) {
 document.querySelectorAll(buttonSelector).forEach((button) => {
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
}

// Fungsi SweetAlert untuk notifikasi sukses
function showSuccessMessage(message) {
 Swal.fire({
     icon: 'success',
     title: 'Sukses!',
     text: message,
     timer: 2000, // durasi alert ditampilkan
     showConfirmButton: false
 });
}

// Inisialisasi DataTable
function initializeDataTable(tableSelector) {
 $(document).ready(function () {
     $(tableSelector).DataTable();
 });
}

// Ekspor fungsi
export { confirmDeletion, showSuccessMessage, initializeDataTable };
