@extends('layouts.main')

@section('title', 'Debug Information')

@section('content')
<section class="debug-section">
    <h1>Debug Information</h1>
    
    <div class="debug-card">
        <h2>Database Connection</h2>
        <div class="debug-result">
            @if($dbConnection)
                <div class="success">Database connection successful!</div>
                <div class="detail">Connected to: {{ config('database.connections.' . config('database.default') . '.database') }}</div>
            @else
                <div class="error">Database connection failed!</div>
                <div class="detail">Error: {{ $dbError }}</div>
            @endif
        </div>
    </div>
    
    <div class="debug-card">
        <h2>Session Test</h2>
        <div class="debug-result">
            <div>Session driver: {{ config('session.driver') }}</div>
            <div>Session data set: {{ session()->has('test_key') ? 'Yes' : 'No' }}</div>
            <div>Session value: {{ session('test_key') }}</div>
            
            <form method="POST" action="{{ route('debug.session') }}">
                @csrf
                <button type="submit">Test Session</button>
            </form>
        </div>
    </div>
    
    <style>
        .debug-section {
            max-width: 800px;
            margin: 0 auto;
            padding: 2rem;
        }
        
        .debug-card {
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            padding: 1.5rem;
            margin-bottom: 1.5rem;
        }
        
        .debug-result {
            background: #f9f9f9;
            border: 1px solid #eee;
            padding: 1rem;
            border-radius: 4px;
        }
        
        .success {
            color: green;
            font-weight: bold;
        }
        
        .error {
            color: red;
            font-weight: bold;
        }
        
        .detail {
            margin-top: 0.5rem;
            font-family: monospace;
        }
    </style>
</section>
@endsection
