@vite(['resources/css/app.css', 'resources/js/app.js'])

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Music Collective</title>
    <!-- Font Awesome -->
    <link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    integrity="sha512-td7uDrzW0Z0g6xk5mgk8WukVqVdEjWXvhg6XHyb2HtU01K04B2Nq28dHxG7yzFrjK3+fHx+uJIVXEd+6gf09YQ=="
    crossorigin="anonymous"
    referrerpolicy="no-referrer"
    />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-900">
    <nav class="p-4 bg-black text-white flex justify-between">
        <a href="/" class="font-bold text-3xl">🎵 Music Collective</a>
        @auth
        <div class="relative inline-block text-left">
            <button id="adminMenuButton" class="bg-gray-800 text-white px-4 py-2 rounded inline-flex justify-center items-center">
                Admin
                <svg class="ml-2 h-4 w-4" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </button>

            <div id="adminMenu" class="origin-top-right absolute right-0 mt-2 w-40 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 hidden">
                <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="adminMenuButton">
                    <a href="{{ route('admin.posts.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100" role="menuitem">Manage Posts</a>
                    <a href="{{ route('admin.artists.index') }}" class="block px-4 py-2 text-gray-700 hover:bg-gray-100" role="menuitem">Manage Artists</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-full text-left px-4 py-2 text-gray-700 hover:bg-gray-100">Logout</button>
                    </form>
                </div>
            </div>
        </div>
        @else
        <a href="/login">Login</a>
        @endauth

    </nav>

    <main class="p-6">
        @if(session('success'))
            <div class="bg-green-200 text-green-800 p-2 mb-4">{{ session('success') }}</div>
        @endif
        @yield('content')
    </main>
    <script>
        const button = document.getElementById('adminMenuButton');
        const menu = document.getElementById('adminMenu');

        button.addEventListener('click', () => {
            menu.classList.toggle('hidden');
        });

        // Close dropdown if clicked outside
        document.addEventListener('click', (e) => {
            if (!button.contains(e.target) && !menu.contains(e.target)) {
                menu.classList.add('hidden');
            }
        });
    </script>

</body>
</html>
