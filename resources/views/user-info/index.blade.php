@extends('layouts.main')

@section('title', 'Tell Us About You')

@section('content')
@if(session('error'))
    <div class="alert alert-danger" style="max-width: 600px; margin: 1rem auto;">
        {{ session('error') }}
    </div>
@endif

<section class="user-info-section">
    <h1>Welcome! 👋</h1>
    <p>Please enter your name and email.</p>
    
    <!-- Debug Info -->
    <div style="margin-bottom: 15px; padding: 10px; background: #f8f9fa; border: 1px solid #ddd; border-radius: 4px; font-size: 0.8rem;">
        <p style="margin: 0 0 5px 0;"><strong>Debug:</strong> Zipcode in session: {{ session('zipcode') ?: 'Not set' }}</p>
    </div>
    
    <form id="user-info-form" method="POST" action="{{ route('user-info.store') }}">
        @csrf
        
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
                placeholder="Phone"
                required
                value="{{ old('phone') }}"
                class="@error('phone') is-invalid @enderror"
            />
            @error('phone')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
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
                placeholder="Age"
                required
                min="18"
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
                <option value="" disabled {{ old('gender') ? '' : 'selected' }}>Gender</option>
                <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
            </select>
            @error('gender')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        
        <p class="terms">
            By clicking "Submit" below, I agree to the 
            <a href="#">Terms & Conditions</a> (which include mandatory arbitration) 
            and the <a href="#">Privacy Policy</a>.
        </p>
        <p class="optional">Sharing your Personal Information is optional</p>
        <div class="actions">
            <button type="submit" class="submit">Submit</button>
        </div>
    </form>
</section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('user-info-form');
        const fields = ['firstName','lastName','email','phone','age','gender'];
        
        fields.forEach(id => {
            const input = form.querySelector(`#${id}`);
            const icon  = form.querySelector(`#${id}-group .icon`);
            const check = "{{ asset('assets/check.png') }}";
            
            // on page load, check if fields have values (from old input)
            if (input.value && input.value.trim()) {
                icon.src = check;
            }
            
            // on every keystroke / change
            input.addEventListener('input', () => {
                if (input.value.trim()) {
                    icon.src = check;
                } else {
                    icon.src = icon.dataset.default;
                }
            });
        });
    });
</script>
@endpush
