@extends('layouts.app')

@section('content')
    <style>
        body {
            font-family: 'Arial', sans-serif;
        }

        .dashboard-container {
            padding: 2rem;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo-title {
            font-weight: bold;
            font-size: 1.5rem;
        }

        .user-greeting {
            margin-top: 1rem;
            font-size: 1.2rem;
        }

        .bold-name {
            font-weight: bold;
            font-size: 1.5rem;
        }

        .section {
            margin-top: 2rem;
        }

        .chart-section {
            text-align: center;
        }

        .chart-image {
            max-width: 100%;
            margin: 0 auto;
            display: block;
        }

        .cards-section {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            margin-top: 2rem;
            gap: 2rem;
        }

        .card-group {
            flex: 1;
            min-width: 280px;
        }

        .card-title {
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .images-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1rem;
        }

        .images-grid img {
            width: 100%;
            border-radius: 12px;
        }

        .mission-cards {
            display: flex;
            gap: 1rem;
        }

        .mission {
            background-color: #6c63ff;
            padding: 1rem;
            border-radius: 15px;
            color: white;
            flex: 1;
            text-align: center;
        }

        .mission h3 {
            margin-bottom: 0.5rem;
        }

        @media (max-width: 768px) {
            .cards-section {
                flex-direction: column;
            }

            .mission-cards {
                flex-direction: column;
            }
        }
    </style>

    <div class="dashboard-container">
        <div class="navbar">
            <div class="logo-title">
                Alcohol Detector <br> Device
            </div>
            <div>
                <a href="#" style="margin-right: 20px;">Home</a>
                <a href="#" style="margin-right: 20px;">Products</a>
                <a href="#">Contacts</a>
            </div>
            <div>
                ⚙️
            </div>
        </div>

        <div class="user-greeting">
            Hello,<br>
            <span class="bold-name">Olivier John</span>
        </div>

        <div class="section chart-section">
            <h3>Alcohol level & test time</h3>
            <img src="{{ asset('images/chart-example.png') }}" alt="Alcohol Level Chart" class="chart-image">
        </div>

        <div class="section cards-section">
            <div class="card-group">
                <div class="card-title">Limit To Drink more alcohol</div>
                <div class="images-grid">
                    <img src="{{ asset('images/limit1.jpg') }}" alt="Limit 1">
                    <img src="{{ asset('images/limit2.jpg') }}" alt="Limit 2">
                    <img src="{{ asset('images/limit3.jpg') }}" alt="Limit 3">
                    <img src="{{ asset('images/limit4.jpg') }}" alt="Limit 4">
                </div>
            </div>

            <div class="card-group">
                <div class="card-title">Recommended Missions</div>
                <div class="mission-cards">
                    <div class="mission">
                        <h3>Prevention</h3>
                        <p>Promote early warning by encouraging awareness before driving or work.</p>
                    </div>
                    <div class="mission">
                        <h3>Safety</h3>
                        <p>Ensure safety by detecting alcohol before risks.</p>
                    </div>
                    <div class="mission">
                        <h3>Compliance</h3>
                        <p>Ensure legal compliance in driving and workplaces.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
