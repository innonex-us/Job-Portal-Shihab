@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Application Settings</span>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('success'))
                        <div class="alert alert-success" role="alert">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif

                    <form action="{{ route('admin.settings.update') }}" method="POST">
                        @csrf
                        
                        <div class="mb-4">
                            <h4>General Settings</h4>
                            <div class="card bg-light p-3">
                                <div class="mb-3">
                                    <label for="service_name" class="form-label">Service Name</label>
                                    <input type="text" class="form-control @error('service_name') is-invalid @enderror" 
                                        id="service_name" name="service_name" 
                                        value="{{ old('service_name', \App\Models\Setting::getValue('service_name', 'Kelly Service')) }}">
                                    <div class="form-text">This appears as the service name in the header of the site</div>
                                    @error('service_name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        
                        <div class="mb-4">
                            <h4>Background Check Settings</h4>
                            <div class="card bg-light p-3">
                                <div class="mb-3">
                                    <label for="verification_url" class="form-label">Verification Button URL</label>
                                    <input type="url" class="form-control @error('verification_url') is-invalid @enderror" 
                                        id="verification_url" name="verification_url" 
                                        value="{{ old('verification_url', \App\Models\Setting::getValue('verification_url', 'https://www.rokonuzzaman.pw')) }}">
                                    <div class="form-text">Where users are redirected after clicking the verification button</div>
                                    @error('verification_url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-primary">Save Settings</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
