    <footer class="footer bottom-0 left-0 w-full bg-blue-500 text-white p-5">
    <nav>
        <p>
            Sano Care
            <br/>
            Copyright &copy;2024 - nano
        </p>
    </nav>
  </footer>
</body>

@if(session('success'))
<script>
 Swal.fire({
     icon: 'success',
     title: 'Sukses!',
     text: '{{ session('success') }}',
     timer: 2000, 
     showConfirmButton: false
 });
</script>
@endif
