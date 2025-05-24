@extends('layouts.sidebar')

@section('content')
<div class="p-6 min-h-screen bg-white">

    <!-- Header Navigation -->
    <div class="flex justify-between items-center mb-10">
        <div class="text-2xl font-bold">
            <span class="border-b-2 border-blue-500">Alcohol Detector</span><br>
            <span class="text-blue-500">Device</span>
        </div>
        <div class="space-x-10 text-gray-400 font-medium">
            <a href="#" class="text-black">Home</a>
            <a href="#">Products</a>
            <a href="#">Contacts</a>
        </div>
    </div>

    <!-- Profile Section -->
    <div class="flex items-start space-x-16 mb-10">
        <!-- Side Menu -->


        <!-- Profile Info -->
        <div class="flex flex-col items-center">
            <img src="{{ asset('images/profile.jpg') }}" alt="Profile Image" class="w-28 h-28 rounded-full object-cover shadow-md">
            <h2 class="mt-3 font-bold text-lg">{{ Auth::user()->name }}</h2>
            <span class="text-sm text-blue-500 bg-blue-100 px-2 rounded-full mt-1">Active</span>
        </div>
    </div>

    <!-- Alcohol Chart -->
   <!-- Alcohol Chart -->
<div class="bg-white shadow rounded-lg p-4 mb-6 h-48"> <!-- Adjust height here -->
    <canvas id="alcoholChart" class="w-full h-full"></canvas>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('alcoholChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri'],
            datasets: [{
                label: 'Alcohol Level',
                data: [0.6, 0.5, 0.8, 0.9, 0.7],
                backgroundColor: '#60a5fa'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            }
        }
    });
</script>


    <!-- Drink Limit and Missions Section -->
    <div class="grid grid-cols-2 gap-6">
        <div>
            <h3 class="text-lg font-semibold mb-2">Limit To Drink more alcohol</h3>
            <div class="grid grid-cols-2 gap-2">
                <img src="/images/drink1.jpg" alt="drink" class="rounded-lg w-24 h-24 object-cover">
                <img src="/images/drink2.jpg" alt="drink" class="rounded-lg w-24 h-24 object-cover">
                <img src="/images/drink3.jpg" alt="drink" class="rounded-lg w-24 h-24 object-cover">
                <img src="/images/drink4.jpg" alt="drink" class="rounded-lg w-24 h-24 object-cover">
            </div>
        </div>
        <div>
            <h3 class="text-lg font-semibold mb-2">Recommended Missions</h3>
            <div class="flex gap-4">
                <div class="bg-purple-200 rounded-2xl p-4 shadow-md">
                    <h4 class="font-bold">Prevention</h4>
                    <p class="text-sm">Promote responsibility by discouraging drunkenness.</p>
                </div>
                <div class="bg-blue-200 rounded-2xl p-4 shadow-md">
                    <h4 class="font-bold">Safety</h4>
                    <p class="text-sm">Ensure safety by reducing alcohol before rides.</p>
                </div>
                <div class="bg-indigo-200 rounded-2xl p-4 shadow-md">
                    <h4 class="font-bold">Compliance</h4>
                    <p class="text-sm">Ensure legal compliance in driving and workplaces.</p>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('alcoholChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Mon', 'Tue', 'Wed', 'Thu', 'Fri'],
            datasets: [{
                label: 'Alcohol Level',
                data: [0.6, 0.5, 0.8, 0.9, 0.7],
                backgroundColor: '#60a5fa'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false }
            }
        }
    });
</script>

@endsection
