@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <span>User Details</span>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-secondary">Back to Users</a>
                </div>

                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <h4>Personal Information</h4>
                            <table class="table">
                                <tr>
                                    <th>Full Name:</th>
                                    <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <th>Phone:</th>
                                    <td>{{ $user->phone }}</td>
                                </tr>
                                <tr>
                                    <th>Age:</th>
                                    <td>{{ $user->age }}</td>
                                </tr>
                                <tr>
                                    <th>Gender:</th>
                                    <td>{{ $user->gender }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h4>Application Details</h4>
                            <table class="table">
                                <tr>
                                    <th>ZIP Code:</th>
                                    <td>{{ $user->zipcode }}</td>
                                </tr>
                                <tr>
                                    <th>IP Address:</th>
                                    <td>{{ $user->ip_address }}</td>
                                </tr>
                                <tr>
                                    <th>Applied On:</th>
                                    <td>{{ $user->created_at->format('M d, Y H:i:s') }}</td>
                                </tr>
                                <tr>
                                    <th>Verification Status:</th>
                                    <td>
                                        @if($user->backgroundCheck && $user->backgroundCheck->verified)
                                            <span class="badge bg-success">Verified</span>
                                            <div class="small text-muted mt-1">
                                                on {{ $user->backgroundCheck->verification_date->format('M d, Y H:i:s') }}
                                            </div>
                                        @else
                                            <span class="badge bg-warning">Pending</span>
                                        @endif
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    <div class="card bg-light mb-4">
                        <div class="card-body">
                            <h5>Actions</h5>
                            <div class="d-flex gap-2">
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" 
                                        onclick="return confirm('Are you sure you want to delete this user? This action cannot be undone.')">
                                        <i class="bi bi-trash"></i> Delete User
                                    </button>
                                </form>
                                
                                @if(!($user->backgroundCheck && $user->backgroundCheck->verified))
                                <form action="{{ route('admin.users.toggle-verification', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-success">
                                        <i class="bi bi-check-circle"></i> Mark as Verified
                                    </button>
                                </form>
                                @else
                                <form action="{{ route('admin.users.toggle-verification', $user->id) }}" method="POST" class="d-inline">
                                    @csrf
                                    <button type="submit" class="btn btn-warning">
                                        <i class="bi bi-x-circle"></i> Mark as Pending
                                    </button>
                                </form>
                                @endif
                                
                                <a href="mailto:{{ $user->email }}" class="btn btn-primary">
                                    <i class="bi bi-envelope"></i> Contact User
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card mb-4">
                        <div class="card-header">
                            Application Timeline
                        </div>
                        <div class="card-body">
                            <ul class="list-group">
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>Application Started</strong>
                                        <div class="small text-muted">User entered zipcode</div>
                                    </div>
                                    <span class="badge bg-primary rounded-pill">{{ $user->created_at->format('M d, Y') }}</span>
                                </li>
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>Profile Completed</strong>
                                        <div class="small text-muted">User provided personal information</div>
                                    </div>
                                    <span class="badge bg-primary rounded-pill">{{ $user->created_at->format('M d, Y') }}</span>
                                </li>
                                @if($user->backgroundCheck && $user->backgroundCheck->verified)
                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                    <div>
                                        <strong>Background Check Verified</strong>
                                        <div class="small text-muted">User completed verification</div>
                                    </div>
                                    <span class="badge bg-success rounded-pill">{{ $user->backgroundCheck->verification_date->format('M d, Y') }}</span>
                                </li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
