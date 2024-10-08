<div class="navbar bg-blue-500 px-4 text-white fixed top-0 w-full z-10">
    <div class="flex-1">
        <a class="text-lg font-bold ml-4" href="{{url('/')}}">Sano Care</a>
    </div>
    {{-- <div class="flex-none w-1/3 lg:mx-[5rem]">
        <input type="text" placeholder="Cari..." class="input input-bordered w-full" />
    </div> --}}
    <div class="flex-none">
        <div class="dropdown dropdown-end">
            <label tabindex="0" class="btn btn-square btn-ghost lg:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </label>
            <ul tabindex="0" class="menu dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52">
                <li class="!text-black"><a href="{{url('/')}}">Home</a></li>
                <li class="!text-black"><a href="{{route('check.index')}}">Meal Plan</a></li>
                <li>
                    @auth
                        <li class="!text-black"><a href="{{route('profile.index')}}">Profile</a></li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <li class="!text-black"><button>{{ __('Logout') }}</button></li>
                        </form>
                    @endauth
                    @guest
                        <li><a href="{{ route('login') }}">{{ __('Login') }}</a></li>
                    @endguest
                </li>
            </ul>
        </div>
        <div class="hidden lg:flex space-x-4">
            <a class="btn btn-ghost" href="{{url('/')}}">Home</a>
            <a class="btn btn-ghost" href="{{route('check.index')}}">Meal Plan</a>
            @auth
            <div class="dropdown dropdown-end">
                <div tabindex="0" role="button" class="btn btn-ghost">Pengaturan Akun</div>
                <ul tabindex="0" class="dropdown-content menu bg-base-100 dark:bg-base-100 rounded-box z-[1] w-52 p-2 shadow">
                    <li class="!text-black"><a href="{{route('profile.index')}}">Profile</a></li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <li class="!text-black"><button>{{ __('Logout') }}</button></li>
                    </form>
                </ul>
            </div>
            @endauth
            @guest
                <a class="btn btn-ghost" href="{{ route('login') }}">{{ __('Login') }}</a>
            @endguest
        </div>
    </div>
</div>
