@extends('layouts.main')

@section('title', 'Tell Us About You')

@section('content')
@if(session('error'))
    <div class="alert alert-danger" style="max-width: 600px; margin: 1rem auto;">
        {{ session('error') }}
    </div>
@endif

<style>
    /* Enhanced user info form styles */
    .user-info-section {
        background-color: #ffffff;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        border-radius: 10px;
        padding: 2.5rem !important;
    }
    
    .user-info-section h1 {
        color: #0045b5;
        font-size: 2.2rem;
        text-align: center;
        margin-bottom: 1rem;
        font-weight: 700;
    }
    
    .user-info-section p.intro {
        text-align: center;
        margin-bottom: 2rem;
        color: #555;
    }
    
    .form-progress {
        display: flex;
        justify-content: space-between;
        margin-bottom: 2rem;
        position: relative;
    }
    
    .form-progress:before {
        content: "";
        position: absolute;
        height: 2px;
        background-color: #e0e0e0;
        width: 100%;
        top: 15px;
        z-index: 1;
    }
    
    .progress-step {
        z-index: 2;
        display: flex;
        flex-direction: column;
        align-items: center;
        position: relative;
    }
    
    .step-number {
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 8px;
        font-size: 14px;
        font-weight: 600;
        background-color: #e0e0e0;
        color: #666;
    }
    
    .progress-step.active .step-number {
        background-color: #0045b5;
        color: #fff;
    }
    
    .progress-step.completed .step-number {
        background-color: #4CAF50;
        color: #fff;
    }
    
    .step-label {
        font-size: 12px;
        color: #666;
        font-weight: 500;
    }
    
    .progress-step.active .step-label {
        color: #0045b5;
        font-weight: 600;
    }
    
    .form-group {
        position: relative;
        margin-bottom: 1.25rem;
        border-radius: 6px;
        overflow: hidden;
        transition: all 0.3s ease;
        border: 1px solid #e0e0e0;
    }
    
    .form-group:focus-within {
        box-shadow: 0 0 0 2px rgba(0,69,181,0.25);
        border-color: #0045b5;
    }
    
    .form-group input, .form-group select {
        width: 100%;
        padding: 14px 14px 14px 50px;
        border: none;
        font-size: 16px;
        background-color: #fff;
    }
    
    /* Safari-specific select styling */
    select {
        -webkit-appearance: none;
        -moz-appearance: none;
        appearance: none;
        background-image: url("data:image/svg+xml;utf8,<svg fill='black' height='24' viewBox='0 0 24 24' width='24' xmlns='http://www.w3.org/2000/svg'><path d='M7 10l5 5 5-5z'/><path d='M0 0h24v24H0z' fill='none'/></svg>");
        background-repeat: no-repeat;
        background-position: right 10px center;
        background-size: 20px;
        padding-right: 30px !important;
    }
    
    /* Fix for Safari input height inconsistency */
    .form-group select {
        height: 51px; /* Match the height of your inputs */
        line-height: normal;
    }
    
    .form-group .icon {
        position: absolute;
        left: 12px;
        top: 50%;
        transform: translateY(-50%);
        width: 24px;
        height: 24px;
        opacity: 0.7;
    }
    
    .icon-check {
        opacity: 1 !important;
    }
    
    .form-divider {
        margin: 2rem 0;
        text-align: center;
        position: relative;
    }
    
    /* .form-divider:before {
        content: "";
        position: absolute;
        height: 1px;
        background-color: #e0e0e0;
        width: 100%;
        top: 50%;
        z-index: 1;
    } */
    
    .divider-text {
        background-color: #fff;
        padding: 0 15px;
        position: relative;
        z-index: 2;
        color: #666;
    }
    
    .terms {
        background-color: #f5f8ff;
        padding: 15px;
        border-radius: 6px;
        font-size: 0.9rem;
        margin: 1.5rem 0;
        color: #555;
    }
    
    .terms a {
        color: #0045b5;
        text-decoration: none;
        font-weight: 600;
    }
    
    .optional {
        text-align: center;
        font-size: 0.85rem;
        color: #777;
        margin-bottom: 1.5rem;
    }
    
    .actions {
        text-align: center;
    }
    
    button.submit {
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
        min-width: 200px;
    }
    
    button.submit:hover {
        background: linear-gradient(135deg, #003da0, #00278f);
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(0,51,160,0.3);
    }
    
    .invalid-feedback {
        color: #dc3545;
        font-size: 0.85rem;
        padding: 0.25rem 0.5rem;
        background-color: #fff;
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
        .step-label {
            display: none;
        }
        
        .form-progress:before {
            top: 15px;
        }
    }
</style>

<section class="user-info-section">
    <h1>Complete Your Profile</h1>
    <p class="intro">Help us get to know you better to find the perfect job match.</p>
    
    <!-- Progress tracker -->
    <div class="form-progress">
        <div class="progress-step completed">
            <div class="step-number">1</div>
            <div class="step-label">Zipcode</div>
        </div>
        <div class="progress-step active">
            <div class="step-number">2</div>
            <div class="step-label">Personal Info</div>
        </div>
        <div class="progress-step">
            <div class="step-number">3</div>
            <div class="step-label">Verification</div>
        </div>
    </div>
    
    <!-- Debug Info -->
    <div class="debug-info">
        <p style="margin: 0 0 5px 0;"><strong>Debug:</strong> Zipcode in session: {{ session('zipcode') ?: 'Not set' }}</p>
    </div>
    
    <form id="user-info-form" method="POST" action="{{ route('user-info.store') }}">
        @csrf
        
        <div class="form-divider">
            <span class="divider-text">Personal Information</span>
        </div>
        
        <div class="form-group" id="firstName-group">
            <img 
                class="icon" 
                src="{{ asset('assets/first-name.png') }}" 
                data-default="{{ asset('assets/first-name.png') }}"
                alt=""
            />
            <input
                type="text" 
                id="firstName" 
                name="firstName" 
                placeholder="First Name"
                required
                value="{{ old('firstName') }}"
                class="@error('firstName') is-invalid @enderror"
            />
            @error('firstName')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group" id="lastName-group">
            <img 
                class="icon" 
                src="{{ asset('assets/last-name.png') }}" 
                data-default="{{ asset('assets/last-name.png') }}"
                alt=""
            />
            <input
                type="text" 
                id="lastName" 
                name="lastName" 
                placeholder="Last Name"
                required
                value="{{ old('lastName') }}"
                class="@error('lastName') is-invalid @enderror"
            />
            @error('lastName')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-divider">
            <span class="divider-text">Contact Information</span>
        </div>
        
        <div class="form-group" id="email-group">
            <img 
                class="icon" 
                src="{{ asset('assets/email.png') }}" 
                data-default="{{ asset('assets/email.png') }}"
                alt=""
            />
            <input
                type="email" 
                id="email" 
                name="email" 
                placeholder="Email Address"
                required
                value="{{ old('email') }}"
                class="@error('email') is-invalid @enderror"
            />
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group" id="phone-group">
            <img 
                class="icon" 
                src="{{ asset('assets/phone.png') }}" 
                data-default="{{ asset('assets/phone.png') }}"
                alt=""
            />
            <input
                type="tel" 
                id="phone" 
                name="phone" 
                placeholder="Phone Number"
                pattern="[0-9]{3}[- ]?[0-9]{3}[- ]?[0-9]{4}"
                title="Please enter a valid phone number (XXX-XXX-XXXX)"
                required
                value="{{ old('phone') }}"
                class="@error('phone') is-invalid @enderror"
            />
            @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-divider">
            <span class="divider-text">Additional Details</span>
        </div>
        
        <div class="form-group" id="age-group">
            <img 
                class="icon" 
                src="{{ asset('assets/age.png') }}" 
                data-default="{{ asset('assets/age.png') }}"
                alt=""
            />
            <input
                type="number" 
                id="age" 
                name="age" 
                placeholder="Age (18+ only)"
                required
                min="18"
                max="100"
                value="{{ old('age') }}"
                class="@error('age') is-invalid @enderror"
            />
            @error('age')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="form-group" id="gender-group">
            <img 
                class="icon" 
                src="{{ asset('assets/gender.png') }}" 
                data-default="{{ asset('assets/gender.png') }}"
                alt=""
            />
            <select id="gender" name="gender" required class="@error('gender') is-invalid @enderror">
                <option value="" disabled {{ old('gender') ? '' : 'selected' }}>Select Gender</option>
                <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                <option value="Prefer not to say" {{ old('gender') == 'Prefer not to say' ? 'selected' : '' }}>Prefer not to say</option>
            </select>
            @error('gender')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <div class="terms">
            <strong>Privacy Notice:</strong> By clicking "Continue" below, I agree to the 
            <a href="#">Terms & Conditions</a> (which include mandatory arbitration) 
            and the <a href="#">Privacy Policy</a>. My information will be used as described in the Privacy Policy.
        </div>
        <p class="optional">Sharing your Personal Information is optional</p>
        <div class="actions">
            <button type="submit" class="submit">Continue</button>
        </div>
    </form>
</section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('user-info-form');
        const fields = ['firstName', 'lastName', 'email', 'phone', 'age', 'gender'];
        const check = "{{ asset('assets/check.png') }}";
        
        // Validate specific fields
        const validators = {
            email: (value) => {
                const re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
                return re.test(value.toLowerCase());
            },
            phone: (value) => {
                const re = /^[0-9]{3}[- ]?[0-9]{3}[- ]?[0-9]{4}$/;
                return re.test(value);
            },
            age: (value) => {
                const age = parseInt(value);
                return age >= 18 && age <= 100;
            }
        };
        
        fields.forEach(id => {
            const input = form.querySelector(`#${id}`);
            const icon = form.querySelector(`#${id}-group .icon`);
            
            // Format phone number as user types
            if (id === 'phone') {
                input.addEventListener('input', (e) => {
                    let value = e.target.value.replace(/\D/g, '');
                    if (value.length > 3 && value.length <= 6) {
                        value = `${value.slice(0, 3)}-${value.slice(3)}`;
                    } else if (value.length > 6) {
                        value = `${value.slice(0, 3)}-${value.slice(3, 6)}-${value.slice(6, 10)}`;
                    }
                    e.target.value = value.slice(0, 12);
                });
            }
            
            // On page load, check if fields have values (from old input)
            if (input.value && input.value.trim()) {
                const isValid = validators[id] ? validators[id](input.value) : input.value.trim() !== '';
                icon.src = isValid ? check : icon.dataset.default;
                if (isValid) {
                    icon.classList.add('icon-check');
                }
            }
            
            // On every keystroke / change
            input.addEventListener('input', () => {
                const isValid = validators[id] ? validators[id](input.value) : input.value.trim() !== '';
                
                if (isValid) {
                    icon.src = check;
                    icon.classList.add('icon-check');
                    input.setCustomValidity('');
                } else {
                    icon.src = icon.dataset.default;
                    icon.classList.remove('icon-check');
                    
                    // Set custom validation messages
                    if (id === 'email' && input.value.trim() !== '') {
                        input.setCustomValidity('Please enter a valid email address');
                    } else if (id === 'phone' && input.value.trim() !== '') {
                        input.setCustomValidity('Please enter a valid phone number (XXX-XXX-XXXX)');
                    } else if (id === 'age' && input.value.trim() !== '') {
                        input.setCustomValidity('Age must be between 18 and 100');
                    } else {
                        input.setCustomValidity('');
                    }
                }
            });
        });
        
        // Form submission validation
        form.addEventListener('submit', (e) => {
            let isValid = true;
            
            fields.forEach(id => {
                const input = form.querySelector(`#${id}`);
                const value = input.value.trim();
                
                if (value === '') {
                    isValid = false;
                    return;
                }
                
                if (validators[id] && !validators[id](value)) {
                    isValid = false;
                }
            });
            
            if (!isValid) {
                e.preventDefault();
                alert('Please correct the errors in the form before submitting.');
            }
        });
    });
</script>
@endpush
