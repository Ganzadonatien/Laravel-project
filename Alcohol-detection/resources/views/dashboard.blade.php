@extends('layouts.sidebar')

@section('content')
<div class="p-6 min-h-screen bg-gradient-to-br from-blue-50 via-white to-indigo-50">

    <!-- Header Navigation -->
    <div class="flex justify-between items-center mb-12">
        <div class="text-3xl font-bold">
            <span class="border-b-3 border-blue-500 pb-1">Alcohol Detector</span><br>
            <span class="text-blue-600 text-xl font-semibold">USER Dashboard</span>
        </div>
        <div class="flex items-center space-x-12">

            <div class="space-x-8 text-gray-600 font-medium">
                <a href="{{ url('/') }}" class="text-gray-900 hover:text-blue-600 transition-colors duration-200 font-semibold border-b-2 border-blue-500 pb-1">Home</a>
                <a href="#" class="hover:text-blue-600 transition-colors duration-200">Contacts</a>
            </div>

            <!-- Device Information Display -->
            <div class="flex items-center space-x-4 bg-white px-6 py-3 rounded-xl border border-gray-200 shadow-lg hover:shadow-xl transition-shadow duration-300">
                <div class="flex items-center space-x-3">
                    <div class="p-2 bg-blue-100 rounded-lg">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                    <div class="text-sm">
                        <div class="text-gray-500 font-medium">Assigned Device:</div>
                        <div class="font-bold text-gray-800 text-base">
                            {{ Auth::user()->device_id ?? 'Not Assigned' }}
                        </div>
                    </div>
                </div>

                @if(Auth::user()->assigned_device)
                    <div class="flex items-center space-x-2 bg-green-50 px-3 py-1 rounded-full">
                        <div class="w-3 h-3 bg-green-500 rounded-full animate-pulse shadow-lg"></div>
                        <span class="text-sm text-green-700 font-semibold">Online</span>
                    </div>
                @else
                    <div class="flex items-center space-x-2 bg-gray-50 px-3 py-1 rounded-full">
                        <div class="w-3 h-3 bg-gray-400 rounded-full"></div>
                        <span class="text-sm text-gray-600 font-medium"></span>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- User Profile Section -->
    <div class="flex items-start space-x-8 mb-12">
        <div class="flex flex-col items-center bg-white p-8 rounded-2xl shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-100">
            <div class="relative">
                <img src="{{ asset('images/profile.jpg') }}" alt="Profile Image" class="w-32 h-32 rounded-full object-cover shadow-lg border-4 border-white">
                <div class="absolute -bottom-2 -right-2 w-8 h-8 bg-green-500 rounded-full border-4 border-white flex items-center justify-center">
                    <div class="w-3 h-3 bg-white rounded-full"></div>
                </div>
            </div>
            <h2 class="mt-4 font-bold text-xl text-gray-800">{{ Auth::user()->name }}</h2>
            <span class="text-sm text-blue-600 bg-blue-100 px-4 py-1 rounded-full mt-2 font-semibold shadow-sm">Active User</span>
        </div>

        <!-- Quick Stats Cards -->
        <div class="flex-1 grid grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Today's Reading</p>
                        <p class="text-2xl font-bold text-gray-800">0.02%</p>
                    </div>
                    <div class="p-3 bg-green-100 rounded-lg">
                        <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Weekly Average</p>
                        <p class="text-2xl font-bold text-gray-800">0.07%</p>
                    </div>
                    <div class="p-3 bg-blue-100 rounded-lg">
                        <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                </div>
            </div>

            <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 border border-gray-100">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500 text-sm font-medium">Last Test</p>
                        <p class="text-2xl font-bold text-gray-800">2h ago</p>
                    </div>
                    <div class="p-3 bg-purple-100 rounded-lg">
                        <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Chart Section -->
    <div class="bg-white shadow-xl rounded-2xl p-8 mb-8 border border-gray-100">
        <div class="flex items-center justify-between mb-6">
            <h3 class="text-xl font-bold text-gray-800">Weekly Alcohol Level Monitoring</h3>
            <div class="flex space-x-2">
                <button class="px-4 py-2 bg-blue-100 text-blue-600 rounded-lg font-medium hover:bg-blue-200 transition-colors duration-200">Week</button>
                <button class="px-4 py-2 text-gray-600 rounded-lg font-medium hover:bg-gray-100 transition-colors duration-200">Month</button>
            </div>
        </div>
        <div class="h-64">
            <canvas id="alcoholChart" class="w-full h-full"></canvas>
        </div>
    </div>

    <!-- Bottom Section -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <!-- Alcohol Limit Section -->
        <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
            <h3 class="text-xl font-bold mb-6 text-gray-800 flex items-center">
                <svg class="w-6 h-6 text-red-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-2.5L13.732 4c-.77-.833-1.964-.833-2.732 0L4.082 15.5c-.77.833.192 2.5 1.732 2.5z"></path>
                </svg>
                Avoid Excessive Alcohol
            </h3>
            <div class="grid grid-cols-2 gap-4">
                <div class="relative group">
                    <img src="/images/drink1.jpg" alt="drink" class="rounded-xl w-full h-28 object-cover shadow-md group-hover:shadow-lg transition-shadow duration-300">
                    <div class="absolute inset-0 bg-red-500 bg-opacity-20 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                        <span class="text-white font-bold text-sm">Limit</span>
                    </div>
                </div>
                <div class="relative group">
                    <img src="/images/drink2.jpg" alt="drink" class="rounded-xl w-full h-28 object-cover shadow-md group-hover:shadow-lg transition-shadow duration-300">
                    <div class="absolute inset-0 bg-red-500 bg-opacity-20 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                        <span class="text-white font-bold text-sm">Limit</span>
                    </div>
                </div>
                <div class="relative group">
                    <img src="/images/drink3.jpg" alt="drink" class="rounded-xl w-full h-28 object-cover shadow-md group-hover:shadow-lg transition-shadow duration-300">
                    <div class="absolute inset-0 bg-red-500 bg-opacity-20 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                        <span class="text-white font-bold text-sm">Limit</span>
                    </div>
                </div>
                <div class="relative group">
                    <img src="/images/drink4.jpg" alt="drink" class="rounded-xl w-full h-28 object-cover shadow-md group-hover:shadow-lg transition-shadow duration-300">
                    <div class="absolute inset-0 bg-red-500 bg-opacity-20 rounded-xl opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-center justify-center">
                        <span class="text-white font-bold text-sm">Limit</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recommended Missions -->
        <div class="bg-white p-8 rounded-2xl shadow-lg border border-gray-100">
            <h3 class="text-xl font-bold mb-6 text-gray-800 flex items-center">
                <svg class="w-6 h-6 text-blue-500 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                </svg>
                Safety Missions
            </h3>
            <div class="space-y-4">
                <div class="bg-gradient-to-r from-purple-100 to-purple-200 rounded-2xl p-6 shadow-md hover:shadow-lg transition-shadow duration-300 border border-purple-200">
                    <div class="flex items-center mb-3">
                        <div class="w-10 h-10 bg-purple-500 rounded-full flex items-center justify-center mr-4">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                            </svg>
                        </div>
                        <h4 class="font-bold text-purple-800 text-lg">Prevention</h4>
                    </div>
                    <p class="text-sm text-purple-700 leading-relaxed">Promote responsibility by discouraging excessive alcohol consumption and maintaining healthy limits.</p>
                </div>

                <div class="bg-gradient-to-r from-blue-100 to-blue-200 rounded-2xl p-6 shadow-md hover:shadow-lg transition-shadow duration-300 border border-blue-200">
                    <div class="flex items-center mb-3">
                        <div class="w-10 h-10 bg-blue-500 rounded-full flex items-center justify-center mr-4">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                            </svg>
                        </div>
                        <h4 class="font-bold text-blue-800 text-lg">Safety</h4>
                    </div>
                    <p class="text-sm text-blue-700 leading-relaxed">Ensure personal and public safety by monitoring alcohol levels before driving or operating machinery.</p>
                </div>

                <div class="bg-gradient-to-r from-indigo-100 to-indigo-200 rounded-2xl p-6 shadow-md hover:shadow-lg transition-shadow duration-300 border border-indigo-200">
                    <div class="flex items-center mb-3">
                        <div class="w-10 h-10 bg-indigo-500 rounded-full flex items-center justify-center mr-4">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                            </svg>
                        </div>
                        <h4 class="font-bold text-indigo-800 text-lg">Compliance</h4>
                    </div>
                    <p class="text-sm text-indigo-700 leading-relaxed">Maintain legal compliance with workplace policies and driving regulations through regular monitoring.</p>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('alcoholChart').getContext('2d');

    // Create gradient
    const gradient = ctx.createLinearGradient(0, 0, 0, 400);
    gradient.addColorStop(0, 'rgba(59, 130, 246, 0.8)');
    gradient.addColorStop(1, 'rgba(59, 130, 246, 0.1)');

    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
            datasets: [{
                label: 'Alcohol Level (%)',
                data: [0.6, 0.5, 0.8, 0.9, 0.7],
                backgroundColor: gradient,
                borderColor: '#3b82f6',
                borderWidth: 2,
                borderRadius: 8,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        color: '#374151',
                        font: {
                            size: 14,
                            weight: '600'
                        }
                    }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    max: 0.12,
                    grid: {
                        color: 'rgba(0, 0, 0, 0.05)',
                    },
                    ticks: {
                        color: '#6b7280',
                        font: {
                            size: 12
                        },
                        callback: function(value) {
                            return value.toFixed(2) + '%';
                        }
                    }
                },
                x: {
                    grid: {
                        display: false,
                    },
                    ticks: {
                        color: '#6b7280',
                        font: {
                            size: 12,
                            weight: '500'
                        }
                    }
                }
            },
            interaction: {
                intersect: false,
                mode: 'index',
            },
            animation: {
                duration: 1000,
                easing: 'easeInOutQuart'
            }
        }
    });
</script>

@endsection
