<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body class="flex min-h-screen bg-gray-100">
    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-lg p-6 space-y-6 border-r">
        <div class="text-center">
            <h2 class="text-2xl font-bold text-blue-600 mb-4">Admin Panel</h2>
        </div>
        <nav class="space-y-4">
            <a href="#" class="flex items-center gap-3 text-gray-700 hover:text-blue-600">
                <i class="fas fa-home"></i> Dashboard
            </a>
            <a href="{{route('admin.users.index')}}" class="flex items-center gap-3 text-gray-700 hover:text-blue-600">
                <i class="fas fa-users"></i> Manage Users
            </a>
            <a href="{{ route('admin.devices.index') }}" class="flex items-center gap-3 text-gray-700 hover:text-blue-600">
                <i class="fas fa-microchip"></i> Manage Devices
            </a>
            <a href="#" class="flex items-center gap-3 text-gray-700 hover:text-blue-600">
                <i class="fas fa-chart-line"></i> Reports
            </a>
            <a href="#" class="flex items-center gap-3 text-gray-700 hover:text-blue-600">
                <i class="fas fa-cog"></i> Settings
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="flex items-center gap-3 text-red-500 hover:text-red-700">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </button>
            </form>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-6">
        @yield('content')
    </main>
</body>
</html>
