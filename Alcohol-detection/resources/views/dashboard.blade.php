<!-- resources/views/user/dashboard.blade.php -->
@extends('layouts.sidebar')

@section('content')
<div class="p-6">
    <h2 class="text-2xl font-bold mb-4">Hello, {{ Auth::user()->name }}</h2>

    <!-- Alcohol Chart Section -->
    <div class="bg-white shadow rounded-lg p-4 mb-6">
        <canvas id="alcoholChart"></canvas>
    </div>

    <!-- Main Content -->
    <div class="grid grid-cols-2 gap-6">
        <!-- Alcohol Limiting Tips -->
        <div>
            <h3 class="text-lg font-semibold mb-2">Limit To Drink more alcohol</h3>
            <div class="grid grid-cols-2 gap-2">
                <img src="/images/drink1.jpg" alt="drink" class="rounded-lg w-28 h-28 object-cover">
                <img src="/images/drink2.jpg" alt="drink" class="rounded-lg w-28 h-28 object-cover">
                <img src="/images/drink3.jpg" alt="drink" class="rounded-lg w-28 h-28 object-cover">
                <img src="/images/drink4.jpg" alt="drink" class="rounded-lg w-28 h-28 object-cover">
            </div>
        </div>

        <!-- Missions Section -->
        <div>
            <h3 class="text-lg font-semibold mb-2">Recommended Missions</h3>
            <div class="flex gap-4">
                <div class="bg-purple-200 rounded-2xl p-4 shadow-md w-1/3">
                    <h4 class="font-bold">Prevention</h4>
                    <p class="text-sm">Promote responsibility by discouraging drunkenness.</p>
                </div>
                <div class="bg-blue-200 rounded-2xl p-4 shadow-md w-1/3">
                    <h4 class="font-bold">Safety</h4>
                    <p class="text-sm">Ensure safety by reducing alcohol before rides.</p>
                </div>
                <div class="bg-indigo-200 rounded-2xl p-4 shadow-md w-1/3">
                    <h4 class="font-bold">Compliance</h4>
                    <p class="text-sm">Ensure legal compliance in driving and workplaces.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div id="chart-root"></div>
@endsection
