@extends('layouts.main')

@section('title', 'Background Check Required')

@section('content')
@if(session('error'))
    <div class="alert alert-danger" style="max-width: 600px; margin: 1rem auto;">
        {{ session('error') }}
    </div>
@endif

<section class="bg-section">
    <h1>Background Check Required</h1>
    
    <!-- Debug Info -->
    <div style="margin-bottom: 15px; padding: 10px; background: #f8f9fa; border: 1px solid #ddd; border-radius: 4px; font-size: 0.8rem;">
        <p style="margin: 0 0 5px 0;"><strong>Debug:</strong> User profile ID in session: {{ session('user_profile_id') ?: 'Not set' }}</p>
    </div>
    
    <p>
        In order to keep our community and partners safe, we perform a standard background
        check on all applicants. This helps us verify your identity, ensure the accuracy
        of the information you've provided, and maintain a trustworthy hiring process.
    </p>
    
    <form action="{{ route('background-check.verify') }}" method="POST">
        @csrf
        <button id="verify-btn" type="submit">Verify</button>
    </form>
    
    <p>
        Our background check process includes identity verification, criminal history screening,
        and employment verification. All data is handled with strict confidentiality.
    </p>

    <div class="trusted-section">
        <h2>Trusted & Verified</h2>
        <p>
            We work with leading background check partners to ensure the reliability and security of our process.
        </p>
        <ul>
            <li>Industry-standard security protocols</li>
            <li>Verified by independent compliance auditors</li>
            <li>Used by 100+ partner organizations</li>
        </ul>
    </div>

    <div class="review-carousel">
        <h2>User Reviews</h2>
        <div class="carousel-track">
            <div class="review">"Seamless and professional process. I felt safe knowing they value security!" – ⭐⭐⭐⭐⭐</div>
            <div class="review">"Very transparent and fast. I got verified within a day." – ⭐⭐⭐⭐⭐</div>
            <div class="review">"Best background check experience I've had in years!" – ⭐⭐⭐⭐⭐</div>
            <div class="review">"Highly trustworthy and secure. Would recommend!" – ⭐⭐⭐⭐⭐</div>
            <div class="review">"Great support and very easy to use system." – ⭐⭐⭐⭐⭐</div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-scroll reviews
        setInterval(() => {
            const track = document.querySelector('.carousel-track');
            track.append(track.firstElementChild.cloneNode(true));
            track.removeChild(track.firstElementChild);
        }, 3000);
    });
</script>
@endpush
