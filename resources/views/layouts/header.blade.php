<div class="navbar bg-blue-500 px-4 text-white fixed top-0 w-full z-10">
    <div class="flex-1">
        <a class="text-lg font-bold ml-4" href="{{url('/')}}">Sano Care</a>
    </div>
    {{-- <div class="flex-none w-1/3 lg:mx-[5rem]">
        <input type="text" placeholder="Cari..." class="input input-bordered w-full" />
    </div> --}}
    <div class="flex-none">
        <div class="lg:hidden dropdown dropdown-end">
            <label tabindex="0" class="btn btn-ghost">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </label>
            <ul tabindex="0" class="menu dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52">
                <li class="{{ request()->routeIs('home') ? 'underline text-white' : '!text-gray-500' }}">
                    <a href="{{route('home')}}">Beranda</a>
                </li>
                <li class="{{ request()->routeIs('meal-plan.index') ? 'underline text-white' : '!text-gray-500' }}">
                    <a href="{{route('meal-plan.index')}}">Rencana Makan</a>
                </li>
                <li class="{{ request()->routeIs('article.index') ? 'underline text-white' : '!text-gray-500' }}">
                    <a href="{{route('article.index')}}">Artikel</a>
                </li>

                @auth
                    <li class="{{ request()->routeIs('profile.index') ? 'underline text-white' : '!text-gray-500' }}">
                        <a href="{{route('profile.index')}}">Profil</a>
                    </li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <li class="!text-gray-500">
                            <button>Keluar</button>
                        </li>
                    </form>
                @endauth

                @guest
                    <li class="{{ request()->routeIs('login') ? 'underline text-white' : '!text-gray-500' }}">
                        <a href="{{ route('login') }}">Masuk</a>
                    </li>
                @endguest
            </ul>
        </div>

        <div class="hidden lg:flex space-x-4">
            <a class="btn btn-ghost text-white hover:underline {{ request()->routeIs('home') ? 'underline' : '' }}"
                href="{{route('home')}}">Beranda</a>

            <a class="btn btn-ghost text-white hover:underline {{ request()->routeIs('meal-plan.index') ? 'underline' : '' }}"
                href="{{route('meal-plan.index')}}">Rencana Makan</a>

            <a class="btn btn-ghost text-white hover:underline {{ request()->routeIs('article.index') ? 'underline' : '' }}"
                href="{{route('article.index')}}">Artikel</a>

            @auth
            <div class="dropdown dropdown-end">
                <div tabindex="0" role="button" class="btn btn-ghost text-white">Pengaturan Akun</div>
                <ul tabindex="0" class="dropdown-content menu bg-base-100 dark:bg-base-100 rounded-box z-[1] w-52 p-2 shadow">
                    <li class="{{ request()->routeIs('profile.index') ? 'underline' : '' }}">
                        <a class="text-white hover:underline" href="{{route('profile.index')}}">Profil</a>
                    </li>
                    <li class="{{ request()->routeIs('log.index') ? 'underline' : '' }}">
                        <a class="text-white hover:underline" href="{{route('log.index')}}">Histori Rencana Makan</a>
                    </li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <li><button class="text-white hover:underline">Keluar</button></li>
                    </form>
                </ul>
            </div>
            @endauth

            @guest
                <a class="btn btn-ghost text-white hover:underline {{ request()->routeIs('login') ? 'underline' : '' }}"
                    href="{{ route('login') }}">Masuk</a>
            @endguest
        </div>
    </div>
</div>
