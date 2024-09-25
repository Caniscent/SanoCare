<div class="navbar bg-blue-500 px-4 text-white">
    <div class="flex-1">
        <a class="text-lg font-bold ml-4" href="{{url('/')}}">Sano Care</a>
    </div>
    <div class="flex-none w-1/3 lg:mx-[8.8rem]">
        <input type="text" placeholder="Cari..." class="input input-bordered w-full" />
    </div>
    <div class="flex-none">
        <div class="dropdown dropdown-end">
            <label tabindex="0" class="btn btn-square btn-ghost lg:hidden">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
                </svg>
            </label>
            <ul tabindex="0" class="menu dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52">
                <li><a href="{{url('/')}}">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Profile</a></li>
            </ul>
        </div>
        <div class="hidden lg:flex space-x-4">
            <a class="btn btn-ghost" href="{{url('/')}}">Home</a>
            <a class="btn btn-ghost" href="#">About</a>
            <a class="btn btn-ghost" href="#">Profile</a>
        </div>
    </div>
</div>
