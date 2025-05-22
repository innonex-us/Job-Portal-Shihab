@extends('layouts.main')

@section('title', 'Find Jobs in Your Area')

@section('content')
@if(session('error'))
    <div class="alert alert-danger" style="max-width: 600px; margin: 1rem auto;">
        {{ session('error') }}
    </div>
@endif

<style>
    .zipcode-helper {
        font-size: 0.8rem;
        color: #666;
        margin-top: 0.25rem;
        text-align: left;
    }
    
    input:invalid {
        border-color: #dc3545;
    }
    
    input:focus:invalid {
        box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
    }
</style>

<section class="job-section">
    <img src="{{ asset('assets/location-icon.png') }}" alt="Location icon">
    <h1>Find Jobs in Your Area</h1>
    <form id="zip-form" method="POST" action="{{ route('zipcode.store') }}">
        @csrf
        <input
            type="text"
            name="zipcode"
            id="zipcode"
            placeholder="Enter your 5-digit zipcode (e.g., 00501)"
            pattern="\d{5}(-\d{4})?"
            maxlength="10"
            required
            value="{{ old('zipcode') }}"
            class="@error('zipcode') is-invalid @enderror"
        />
        @error('zipcode')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
        <div class="zipcode-helper">Please enter a valid 5-digit US zipcode (e.g., 00501)</div>
        <ul class="info-list">
            <li>Applicants needed</li>
            <li>Pay and job availability vary by location and experience</li>
        </ul>
        <button type="submit">Continue</button>
    </form>
    <p class="disclaimer">
        This site may provide a list of third-party job postings and is not affiliated
        with any employer. You may be transferred to a third-party website to apply for a specific job.
    </p>
</section>
@endsection
