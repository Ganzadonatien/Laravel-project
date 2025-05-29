<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Profile and Settings</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-white text-gray-800 font-sans flex">

    <!-- Sidebar (Left Side) -->
    <aside class="w-72 h-screen bg-white border-r px-6 py-8 space-y-6">

        <!-- Avatar and Name -->


        <!-- Navigation Links -->
        <div class="space-y-4">
            <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 text-gray-700 hover:text-blue-600">
                <i class="fas fa-user text-blue-500"></i> Profile
            </a>
            <a href="#" class="flex items-center gap-3 text-gray-700 hover:text-blue-600">
                <i class="fas fa-heart text-blue-500"></i> Favorite
            </a>
            
            <a href="#" class="flex items-center gap-3 text-gray-700 hover:text-blue-600">
                <i class="fas fa-lock text-blue-500"></i> Privacy Policy
            </a>
            <a href="#" class="flex items-center gap-3 text-gray-700 hover:text-blue-600">
                <i class="fas fa-cog text-blue-500"></i> Settings
            </a>
            <a href="#" class="flex items-center gap-3 text-gray-700 hover:text-blue-600">
                <i class="fas fa-question-circle text-blue-500"></i> Help
            </a>
            <form action="{{ route('logout') }}" method="POST" class="flex items-center gap-3 text-red-500 hover:text-red-700">
                @csrf
                <i class="fas fa-sign-out-alt"></i>
                <button type="submit">Logout</button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 bg-gray-50 p-8">
        @yield('content')
    </main>
</body>
</html>
