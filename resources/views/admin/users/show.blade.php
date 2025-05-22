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
                            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this user?')">
                                    Delete User
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
