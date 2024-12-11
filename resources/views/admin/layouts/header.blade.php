<header class="flex fixed flex-wrap items-center justify-between  bg-white px-4 py-4 shadow w-full">
    <button class="lg:hidden  text-gray-600 hover:text-gray-900 focus:outline-none" id="sidebar-toggle">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h8m-8 6h16" />
        </svg>
    </button>
    <h2 class="text-lg font-semibold md:text-xl flex-1 text-center lg:text-left lg:flex-none">@yield('title')</h2>
</header>
<script>
    const sidebar = document.getElementById('sidebar');
    const sidebarToggle = document.getElementById('sidebar-toggle');

    function toggleSidebar() {
        if (sidebar.classList.contains('-translate-x-full')) {
            sidebar.classList.remove('-translate-x-full');
            sidebarToggle.classList.add('hidden');
        } else {
            sidebar.classList.add('-translate-x-full');
            sidebarToggle.classList.remove('hidden');
        }
    }

    sidebarToggle.addEventListener('click', (e) => {
        e.stopPropagation(); 
        toggleSidebar();
    });

    document.addEventListener('click', (e) => {
        const clickedInsideSidebar = sidebar.contains(e.target);
        const clickedToggleButton = sidebarToggle.contains(e.target);

        if (!clickedInsideSidebar && !clickedToggleButton && !sidebar.classList.contains('-translate-x-full')) {
            sidebar.classList.add('-translate-x-full');
            sidebarToggle.classList.remove('hidden');
        }
    });
  </script>
