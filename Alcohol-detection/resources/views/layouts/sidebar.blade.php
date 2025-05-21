<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="flex">
    <!-- Sidebar -->
    <aside class="w-64 h-screen bg-gray-800 text-white p-6 space-y-6">
        <h2 class="text-xl font-bold">Alcohol Detector</h2>
        <nav class="space-y-2">
            <a href="{{ route('dashboard') }}" class="block">Dashboard</a>
            <a href="{{ route('profile.edit') }}" class="block">Edit Profile</a>
            <form method="POST" action="{{ route('profile.delete') }}">
                @csrf
                @method('DELETE')
                <button class="block w-full text-left text-red-400">Delete Account</button>
            </form>
            <a href="{{ route('logout') }}" class="block text-gray-400"
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
            <form id="logout-form" method="POST" action="{{ route('logout') }}" class="hidden">
                @csrf
            </form>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 bg-gray-100">
        @yield('content')
    </main>
</body>
</html>
