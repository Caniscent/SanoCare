<nav class="navbar bg-base-100 shadow-lg">
    <!-- Logo -->
    <div class="flex-1">
        <a class="btn btn-ghost normal-case text-xl" href="{{ url('/') }}">Sano Care</a>
    </div>

    <!-- Search Bar (Hidden on Mobile) -->
    <div class="hidden md:flex flex-1 justify-center">
        <input type="text" placeholder="Search..." class="input input-bordered w-full max-w-xs" />
    </div>

    <!-- Navbar Items -->
    <div class="flex-none">
        <div class="hidden md:flex space-x-4">
            <a class="btn btn-ghost" href="{{ url('/') }}>Home</a>
            <a class="btn btn-ghost">About</a>
            <a class="btn btn-ghost">Services</a>
            <a class="btn btn-ghost">Profile</a>
        </div>

        <!-- Hamburger Menu (Visible on Mobile) -->
        <div class="dropdown dropdown-end md:hidden">
            <label tabindex="0" class="btn btn-ghost lg:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" /></svg>
            </label>
            <ul tabindex="0" class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52">
                <li><a>Home</a></li>
                <li><a>About</a></li>
                <li><a>Services</a></li>
                <li><a>Contact</a></li>
            </ul>
        </div>
    </div>
</nav>
