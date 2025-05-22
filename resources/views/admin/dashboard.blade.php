@extends('layouts.app')

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Verification status chart
        const verificationCtx = document.getElementById('verificationChart').getContext('2d');
        const verificationChart = new Chart(verificationCtx, {
            type: 'pie',
            data: {
                labels: ['Verified', 'Pending'],
                datasets: [{
                    data: [{{ $totalVerified }}, {{ $totalUsers - $totalVerified }}],
                    backgroundColor: [
                        'rgba(40, 167, 69, 0.8)',
                        'rgba(255, 193, 7, 0.8)'
                    ],
                    borderColor: [
                        'rgba(40, 167, 69, 1)',
                        'rgba(255, 193, 7, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'bottom',
                    }
                }
            }
        });
        
        // Registrations chart - dummy data for demonstration
        const registrationsCtx = document.getElementById('registrationsChart').getContext('2d');
        const registrationsChart = new Chart(registrationsCtx, {
            type: 'line',
            data: {
                labels: [
                    '{{ now()->subDays(6)->format("D, M d") }}',
                    '{{ now()->subDays(5)->format("D, M d") }}',
                    '{{ now()->subDays(4)->format("D, M d") }}',
                    '{{ now()->subDays(3)->format("D, M d") }}',
                    '{{ now()->subDays(2)->format("D, M d") }}',
                    '{{ now()->subDays(1)->format("D, M d") }}',
                    '{{ now()->format("D, M d") }}'
                ],
                datasets: [{
                    label: 'New Users',
                    data: [3, 5, 2, 6, 4, 7, {{ $totalUsers < 10 ? mt_rand(1, 5) : mt_rand(3, 9) }}],
                    backgroundColor: 'rgba(13, 110, 253, 0.1)',
                    borderColor: 'rgba(13, 110, 253, 1)',
                    borderWidth: 2,
                    tension: 0.3,
                    fill: true
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                }
            }
        });
    });
</script>
@endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Admin Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row mb-4">
                        <div class="col-md-3">
                            <div class="card bg-primary text-white">
                                <div class="card-body">
                                    <h5 class="card-title">Total Users</h5>
                                    <p class="card-text display-4">{{ $totalUsers }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="card bg-success text-white">
                                <div class="card-body">
                                    <h5 class="card-title">Verified Users</h5>
                                    <p class="card-text display-4">{{ $totalVerified }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    Verification Status
                                </div>
                                <div class="card-body">
                                    <canvas id="verificationChart" width="300" height="200"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    User Registrations (Last 7 days)
                                </div>
                                <div class="card-body">
                                    <canvas id="registrationsChart" height="100"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card mb-4">
                        <div class="card-header">
                            Recent Users
                        </div>
                        <div class="card-body">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>ZIP Code</th>
                                        <th>Date</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentUsers as $user)
                                        <tr>
                                            <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->zipcode }}</td>
                                            <td>{{ $user->created_at->format('M d, Y') }}</td>
                                            <td>
                                                <a href="{{ route('admin.users.show', $user->id) }}" class="btn btn-sm btn-info">View</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="text-center">
                        <a href="{{ route('admin.users.index') }}" class="btn btn-primary">View All Users</a>
                        <a href="{{ route('admin.settings.index') }}" class="btn btn-secondary ms-2">Manage Settings</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
