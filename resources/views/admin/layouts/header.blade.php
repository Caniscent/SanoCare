<header class="flex fixed flex-wrap items-center justify-between  bg-white px-4 py-4 shadow w-full">
    <!-- Sidebar Toggle Button -->
    <button class="lg:hidden  text-gray-600 hover:text-gray-900 focus:outline-none" id="sidebar-toggle">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
        </svg>
    </button>
    <h2 class="text-lg font-semibold md:text-xl flex-1 text-center lg:text-left lg:flex-none">@yield('title')</h2>
</header>
<script>
    // Ambil elemen sidebar dan tombol toggle
    const sidebar = document.getElementById('sidebar');
    const sidebarToggle = document.getElementById('sidebar-toggle');

    // Fungsi untuk toggle sidebar
    function toggleSidebar() {
        if (sidebar.classList.contains('-translate-x-full')) {
            sidebar.classList.remove('-translate-x-full');
            sidebarToggle.classList.add('hidden');
        } else {
            sidebar.classList.add('-translate-x-full');
            sidebarToggle.classList.remove('hidden');
        }
    }

    // Event listener untuk toggle sidebar dengan tombol
    sidebarToggle.addEventListener('click', (e) => {
        e.stopPropagation(); // Mencegah event klik dari menyebar ke body
        toggleSidebar();
    });

    // Event listener untuk menutup sidebar jika klik di luar sidebar
    document.addEventListener('click', (e) => {
        const clickedInsideSidebar = sidebar.contains(e.target);
        const clickedToggleButton = sidebarToggle.contains(e.target);

        if (!clickedInsideSidebar && !clickedToggleButton && !sidebar.classList.contains('-translate-x-full')) {
            sidebar.classList.add('-translate-x-full');
            sidebarToggle.classList.remove('hidden');
        }
    });
  </script>

{{-- <header class="flex items-center justify-between bg-blue-500 text-white px-4 py-2 shadow">
    <button class="lg:hidden focus:outline-none" id="sidebar-toggle">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
        </svg>
    </button>
    <h1 class="text-xl font-bold">Admin Dashboard</h1>
</header> --}}
