@extends('layouts.admin')

@section('content')
<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100">
    <div class="container mx-auto px-4 py-8">
        <!-- Welcome Section -->
        <div class="mb-8">
            <div class="bg-white rounded-2xl shadow-xl p-8 border-l-8 border-blue-500">
                <div class="flex items-center justify-between">
                    <div>
                        <h1 class="text-4xl font-bold text-gray-800 mb-2">
                            Welcome back, {{ Auth::user()->name ?? 'Admin' }}! 👋
                        </h1>
                        <p class="text-gray-600 text-lg">
                            Here's what's happening with your system today.
                        </p>
                        <div class="mt-4 flex items-center">
                            <span class="px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-sm font-medium">
                                {{ Auth::user()->usertype ?? 'Admin' }}
                            </span>
                            <span class="ml-3 text-gray-500">
                                @if(Auth::user() && isset(Auth::user()->last_login) && Auth::user()->last_login)
                                    Last login: {{ \Carbon\Carbon::parse(Auth::user()->last_login)->format('M d, Y H:i') }}
                                @else
                                    Last login: Not available
                                @endif
                            </span>
                        </div>
                    </div>
                    <div class="hidden md:block">
                        <div class="w-32 h-32 bg-gradient-to-br from-blue-400 to-purple-500 rounded-full flex items-center justify-center">
                            <i class="fas fa-tachometer-alt text-white text-4xl"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Statistics Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Users Card -->
            <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-blue-500 hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium uppercase tracking-wider">Total Users</p>
                        <p class="text-3xl font-bold text-gray-800 mt-2">{{ number_format($totalUsers ?? 0) }}</p>
                        <div class="flex items-center mt-2">
                            <span class="text-green-500 text-sm font-medium">
                                <i class="fas fa-arrow-up mr-1"></i>
                                Active
                            </span>
                        </div>
                    </div>
                    <div class="bg-blue-100 p-4 rounded-full">
                        <i class="fas fa-users text-blue-500 text-2xl"></i>
                    </div>
                </div>
            </div>

            <!-- Total Devices Card -->
            <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-green-500 hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium uppercase tracking-wider">Total Devices</p>
                        <p class="text-3xl font-bold text-gray-800 mt-2">{{ number_format($totalDevices ?? 0) }}</p>
                        <div class="flex items-center mt-2">
                            <span class="text-blue-500 text-sm font-medium">
                                <i class="fas fa-info-circle mr-1"></i>
                                Registered
                            </span>
                        </div>
                    </div>
                    <div class="bg-green-100 p-4 rounded-full">
                        <i class="fas fa-laptop text-green-500 text-2xl"></i>
                    </div>
                </div>
            </div>

            <!-- Assigned Devices Card -->
            <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-orange-500 hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium uppercase tracking-wider">Assigned Devices</p>
                        <p class="text-3xl font-bold text-gray-800 mt-2">{{ number_format($assignedDevices ?? 0) }}</p>
                        <div class="flex items-center mt-2">
                            <span class="text-orange-500 text-sm font-medium">
                                <i class="fas fa-link mr-1"></i>
                                In Use
                            </span>
                        </div>
                    </div>
                    <div class="bg-orange-100 p-4 rounded-full">
                        <i class="fas fa-desktop text-orange-500 text-2xl"></i>
                    </div>
                </div>
            </div>

            <!-- Available Devices Card -->
            <div class="bg-white rounded-xl shadow-lg p-6 border-l-4 border-purple-500 hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-600 text-sm font-medium uppercase tracking-wider">Available Devices</p>
                        <p class="text-3xl font-bold text-gray-800 mt-2">{{ number_format($availableDevices ?? 0) }}</p>
                        <div class="flex items-center mt-2">
                            <span class="text-purple-500 text-sm font-medium">
                                <i class="fas fa-check-circle mr-1"></i>
                                Ready
                            </span>
                        </div>
                    </div>
                    <div class="bg-purple-100 p-4 rounded-full">
                        <i class="fas fa-server text-purple-500 text-2xl"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Charts and Recent Activity -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 mb-8">
            <!-- User Type Distribution -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                    <i class="fas fa-chart-pie text-blue-500 mr-3"></i>
                    User Type Distribution
                </h3>
                <div class="space-y-4">
                    @if(isset($usersByRole) && count($usersByRole) > 0)
                        @foreach($usersByRole as $role => $count)
                            @php
                                $totalUsersCount = $totalUsers ?? 1;
                                $percentage = $totalUsersCount > 0 ? round(($count / $totalUsersCount) * 100, 1) : 0;
                                $colorClass = match(strtolower($role)) {
                                    'admin' => 'bg-red-500',
                                    'moderator' => 'bg-blue-500',
                                    'user' => 'bg-green-500',
                                    'viewer' => 'bg-gray-500',
                                    default => 'bg-indigo-500'
                                };
                            @endphp
                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <div class="w-4 h-4 rounded-full {{ $colorClass }} mr-3"></div>
                                    <span class="text-gray-700 font-medium">{{ ucfirst($role) }}</span>
                                </div>
                                <div class="flex items-center">
                                    <span class="text-gray-600 mr-2">{{ $count }}</span>
                                    <span class="text-sm text-gray-500">({{ $percentage }}%)</span>
                                </div>
                            </div>
                            <div class="w-full bg-gray-200 rounded-full h-2">
                                <div class="h-2 rounded-full {{ $colorClass }}" style="width: {{ $percentage }}%"></div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-8">
                            <i class="fas fa-chart-pie text-gray-300 text-4xl mb-4"></i>
                            <p class="text-gray-500">No user data available</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Recent Users -->
            <div class="bg-white rounded-xl shadow-lg p-6">
                <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                    <i class="fas fa-user-plus text-green-500 mr-3"></i>
                    Recent Users
                </h3>
                <div class="space-y-4">
                    @if(isset($recentUsers) && $recentUsers->count() > 0)
                        @foreach($recentUsers as $user)
                            <div class="flex items-center justify-between p-3 bg-gray-50 rounded-lg hover:bg-gray-100 transition-colors">
                                <div class="flex items-center">
                                    <div class="w-10 h-10 bg-gradient-to-br from-blue-400 to-purple-500 rounded-full flex items-center justify-center text-white font-bold">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div class="ml-3">
                                        <p class="font-medium text-gray-800">{{ $user->name }}</p>
                                        <p class="text-sm text-gray-600">{{ $user->email }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <span class="px-2 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-medium">
                                        {{ $user->usertype ?? 'User' }}
                                    </span>
                                    <p class="text-xs text-gray-500 mt-1">
                                        {{ $user->created_at->diffForHumans() }}
                                    </p>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <div class="text-center py-8">
                            <i class="fas fa-users text-gray-300 text-4xl mb-4"></i>
                            <p class="text-gray-500">No users found</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="bg-white rounded-xl shadow-lg p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                <i class="fas fa-bolt text-yellow-500 mr-3"></i>
                Quick Actions
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                <div class="flex items-center p-4 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-lg hover:from-blue-600 hover:to-blue-700 transition-all duration-300 transform hover:scale-105 cursor-pointer">
                    <i class="fas fa-user-plus text-2xl mr-4"></i>
                    <div>
                        <p class="font-semibold">Add User</p>
                        <p class="text-sm opacity-90">Create new user</p>
                    </div>
                </div>

                <div class="flex items-center p-4 bg-gradient-to-r from-green-500 to-green-600 text-white rounded-lg hover:from-green-600 hover:to-green-700 transition-all duration-300 transform hover:scale-105 cursor-pointer">
                    <i class="fas fa-plus-circle text-2xl mr-4"></i>
                    <div>
                        <p class="font-semibold">Add Device</p>
                        <p class="text-sm opacity-90">Register device</p>
                    </div>
                </div>

                <div class="flex items-center p-4 bg-gradient-to-r from-purple-500 to-purple-600 text-white rounded-lg hover:from-purple-600 hover:to-purple-700 transition-all duration-300 transform hover:scale-105 cursor-pointer">
                    <i class="fas fa-users text-2xl mr-4"></i>
                    <div>
                        <p class="font-semibold">Manage Users</p>
                        <p class="text-sm opacity-90">View all users</p>
                    </div>
                </div>

                <div class="flex items-center p-4 bg-gradient-to-r from-orange-500 to-orange-600 text-white rounded-lg hover:from-orange-600 hover:to-orange-700 transition-all duration-300 transform hover:scale-105 cursor-pointer">
                    <i class="fas fa-laptop text-2xl mr-4"></i>
                    <div>
                        <p class="font-semibold">Manage Devices</p>
                        <p class="text-sm opacity-90">View all devices</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- System Status -->
        <div class="mt-8 bg-white rounded-xl shadow-lg p-6">
            <h3 class="text-xl font-bold text-gray-800 mb-6 flex items-center">
                <i class="fas fa-heartbeat text-red-500 mr-3"></i>
                System Status
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="text-center">
                    <div class="w-16 h-16 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-check-circle text-green-500 text-2xl"></i>
                    </div>
                    <h4 class="font-semibold text-gray-800">System Health</h4>
                    <p class="text-green-600 font-medium">Excellent</p>
                </div>

                <div class="text-center">
                    <div class="w-16 h-16 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-database text-blue-500 text-2xl"></i>
                    </div>
                    <h4 class="font-semibold text-gray-800">Database</h4>
                    <p class="text-blue-600 font-medium">Connected</p>
                </div>

                <div class="text-center">
                    <div class="w-16 h-16 bg-purple-100 rounded-full flex items-center justify-center mx-auto mb-3">
                        <i class="fas fa-shield-alt text-purple-500 text-2xl"></i>
                    </div>
                    <h4 class="font-semibold text-gray-800">Security</h4>
                    <p class="text-purple-600 font-medium">Protected</p>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .container > div {
        animation: fadeInUp 0.6s ease-out;
    }

    .container > div:nth-child(2) { animation-delay: 0.1s; }
    .container > div:nth-child(3) { animation-delay: 0.2s; }
    .container > div:nth-child(4) { animation-delay: 0.3s; }
    .container > div:nth-child(5) { animation-delay: 0.4s; }
</style>
@endsection
