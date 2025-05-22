@extends('layouts.main')

@section('title', 'Background Check Required')

@section('content')
@if(session('error'))
    <div class="alert alert-danger" style="max-width: 600px; margin: 1rem auto;">
        {{ session('error') }}
    </div>
@endif

<style>
    /* Enhanced background check styles */
    .bg-section {
        background-color: #ffffff;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        border-radius: 10px;
        padding: 2.5rem !important;
    }
    
    .bg-section h1 {
        color: #0045b5;
        font-size: 2.2rem;
        text-align: center;
        margin-bottom: 1.8rem;
        font-weight: 700;
        border-bottom: 2px solid #f0f4ff;
        padding-bottom: 1rem;
    }
    
    .verification-badge {
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 2rem 0;
    }
    
    .badge-icon {
        width: 80px;
        height: 80px;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f0f7ff;
        border-radius: 50%;
        margin-right: 1.5rem;
    }
    
    .badge-icon svg {
        width: 40px;
        height: 40px;
        color: #0045b5;
    }
    
    .verification-button {
        text-align: center;
        margin: 2rem 0;
    }
    
    #verify-btn {
        background: linear-gradient(135deg, #0045b5, #0033a0);
        color: white;
        border: none;
        padding: 14px 28px;
        border-radius: 50px;
        font-size: 18px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        box-shadow: 0 4px 8px rgba(0,51,160,0.2);
        max-width: 250px;
    }
    
    #verify-btn:hover {
        background: linear-gradient(135deg, #003da0, #00278f);
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0,51,160,0.3);
    }
    
    .info-box {
        background-color: #f9fbff;
        border-left: 4px solid #0045b5;
        padding: 1.2rem;
        margin: 1.5rem 0;
        border-radius: 0 8px 8px 0;
    }
    
    .trusted-section {
        margin-top: 2.5rem;
        padding-top: 2rem;
        border-top: 2px dashed #eef2ff;
    }
    
    .trusted-section h2 {
        color: #0045b5;
        font-size: 1.6rem;
        margin-bottom: 1.2rem;
        font-weight: 600;
    }
    
    .trusted-section ul {
        list-style: none;
        margin: 1.5rem 0;
        padding-left: 1rem;
    }
    
    .trusted-section li {
        position: relative;
        padding-left: 2rem;
        margin-bottom: 1rem;
        line-height: 1.5;
    }
    
    .trusted-section li:before {
        content: "✓";
        position: absolute;
        left: 0;
        color: #0045b5;
        font-weight: bold;
        font-size: 1.2rem;
    }
    
    .review-carousel {
        margin-top: 2.5rem;
        background-color: #f5f8ff;
        padding: 1.5rem;
        border-radius: 8px;
        overflow: hidden;
    }
    
    .review-carousel h2 {
        color: #0045b5;
        font-size: 1.6rem;
        margin-bottom: 1.2rem;
        font-weight: 600;
        text-align: center;
    }
    
    .carousel-track {
        display: flex;
        animation: scroll 30s linear infinite;
    }
    
    .review {
        flex: 0 0 100%;
        padding: 1.2rem 1.5rem;
        background: #ffffff;
        border-radius: 8px;
        margin-right: 1.5rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        font-style: italic;
    }
    
    @keyframes scroll {
        0% { transform: translateX(0); }
        100% { transform: translateX(-500%); }
    }
    
    .process-steps {
        display: flex;
        justify-content: space-between;
        margin: 2rem 0;
        flex-wrap: wrap;
    }
    
    .step {
        flex: 0 0 30%;
        text-align: center;
        padding: 1rem;
    }
    
    .step-icon {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 60px;
        height: 60px;
        background-color: #e8f0ff;
        border-radius: 50%;
        margin-bottom: 0.8rem;
    }
    
    .step-title {
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: #0045b5;
    }
    
    /* Hide debug info in production */
    .debug-info {
        display: {{ app()->environment('local') ? 'block' : 'none' }};
        margin-bottom: 15px;
        padding: 10px;
        background: #f8f9fa;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 0.8rem;
    }

    /* Make the design responsive */
    @media (max-width: 768px) {
        .process-steps {
            flex-direction: column;
        }
        
        .step {
            flex: 0 0 100%;
            margin-bottom: 1.5rem;
        }
        
        .verification-badge {
            flex-direction: column;
            text-align: center;
        }
        
        .badge-icon {
            margin-right: 0;
            margin-bottom: 1rem;
        }
    }
</style>

<section class="bg-section">
    <h1>Background Check Required</h1>
    
    <!-- Debug Info -->
    <div class="debug-info">
        <p style="margin: 0 0 5px 0;"><strong>Debug:</strong> User profile ID in session: {{ session('user_profile_id') ?: 'Not set' }}</p>
    </div>
    
    <div class="verification-badge">
        <div class="badge-icon">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
            </svg>
        </div>
        <div>
            <h2 style="margin-top:0; font-size:1.4rem;">Your Job Application is Almost Complete</h2>
            <p style="margin-bottom:0;">Please complete our security verification process.</p>
        </div>
    </div>
    
    <div class="info-box">
        <p>
            In order to keep our community and partners safe, we perform a standard background
            check on all applicants. This helps us verify your identity, ensure the accuracy
            of the information you've provided, and maintain a trustworthy hiring process.
        </p>
    </div>
    
    <div class="process-steps">
        <div class="step">
            <div class="step-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#0045b5" viewBox="0 0 24 24">
                    <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm0 3c1.66 0 3 1.34 3 3s-1.34 3-3 3-3-1.34-3-3 1.34-3 3-3zm0 14.2c-2.5 0-4.71-1.28-6-3.22.03-1.99 4-3.08 6-3.08 1.99 0 5.97 1.09 6 3.08-1.29 1.94-3.5 3.22-6 3.22z"/>
                </svg>
            </div>
            <div class="step-title">Identity Verification</div>
            <p>We ensure you are who you say you are</p>
        </div>
        <div class="step">
            <div class="step-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#0045b5" viewBox="0 0 24 24">
                    <path d="M19 5v14H5V5h14m1.1-2H3.9c-.5 0-.9.4-.9.9v16.2c0 .4.4.9.9.9h16.2c.4 0 .9-.5.9-.9V3.9c0-.5-.5-.9-.9-.9zM11 7h6v2h-6V7zm0 4h6v2h-6v-2zm0 4h6v2h-6v-2zm-4-8h2v2H7V7zm0 4h2v2H7v-2zm0 4h2v2H7v-2z"/>
                </svg>
            </div>
            <div class="step-title">Record Check</div>
            <p>Quick screening of necessary records</p>
        </div>
        <div class="step">
            <div class="step-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="#0045b5" viewBox="0 0 24 24">
                    <path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z"/>
                </svg>
            </div>
            <div class="step-title">Secure Process</div>
            <p>All data is encrypted and confidential</p>
        </div>
    </div>
    
    <div class="verification-button">
        <form action="{{ route('background-check.verify') }}" method="POST">
            @csrf
            <button id="verify-btn" type="submit">Complete Verification</button>
        </form>
    </div>
    
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
            <li>Industry-standard security protocols and data encryption</li>
            <li>Verified by independent compliance auditors</li>
            <li>Used by 100+ partner organizations worldwide</li>
            <li>Compliant with all applicable privacy laws and regulations</li>
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
            if (track) {
                track.append(track.firstElementChild.cloneNode(true));
                track.removeChild(track.firstElementChild);
            }
        }, 3000);
    });
</script>
@endpush
