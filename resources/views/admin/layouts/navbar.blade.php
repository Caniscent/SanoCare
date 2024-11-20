<aside
    class="fixed inset-y-0 left-0 z-30 w-64 bg-blue-500 text-white transform lg:translate-x-0 lg:relative transition-transform duration-300 ease-in-out h-screen overflow-y-auto"
    id="sidebar">
    <div class="p-4">
        <h1 class="text-2xl font-bold">Sano Care Admin</h1>
    </div>
    <nav class="mt-4">
      <ul class="space-y-2">
        <li>
            <a href="{{ route('admin.index') }}" class="flex items-center px-4 py-2 hover:bg-blue-600 rounded">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h18M3 10h18M3 17h18"></path>
                </svg>
                Dashboard
            </a>
        </li>
        <li>
            <a href="{{ route('admin.article.index') }}" class="flex items-center px-4 py-2 hover:bg-blue-600 rounded">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c2.21 0 4-1.79 4-4S14.21 0 12 0 8 1.79 8 4s1.79 4 4 4z"></path>
                </svg>
                Artikel
            </a>
        </li>
        <li>
            <details>
                <summary class="cursor-pointer flex items-center px-4 py-2 hover:bg-blue-600 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h18M3 10h18M3 17h18"></path>
                    </svg>
                    Pengaturan
                </summary>
                <ul class="pl-6 space-y-1 mt-2">
                    <li>
                        <a href="#" class="block px-2 py-1 hover:bg-blue-700 rounded">Submenu 1</a>
                    </li>
                    <li>
                        <a href="#" class="block px-2 py-1 hover:bg-blue-700 rounded">Submenu 2</a>
                    </li>
                </ul>
            </details>
        </li>
        <li>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button><a href="#" class="flex items-center px-4 py-2 hover:bg-blue-600 rounded">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2 text-gray-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h18M3 10h18M3 17h18"></path>
                </svg>
                Logout
            </a>
            {{ __('Logout') }}</button>
            </form>
        </li>
    </ul>
    
    </nav>
</aside>


