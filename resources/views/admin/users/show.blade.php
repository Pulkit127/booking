@extends('admin.layouts')

@section('content')
    <div class="content-page">
        <div class="container mt-4">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="card shadow-lg p-4">
                <div class="row">
                    <!-- Profile Picture Section -->
                    <div class="col-md-4 text-center">
                        <div class="profile-img">
                            @if ($user->profile_picture)
                                <img src="{{ asset('public/storage/' . $user->profile_picture) }}"
                                    class="rounded-circle shadow border border-3 border-primary" alt="Profile Picture"
                                    width="150" height="150">
                            @else
                                <img src="{{ asset('images/default-avatar.png') }}"
                                    class="rounded-circle shadow border border-3 border-secondary" alt="Default Profile"
                                    width="150" height="150">
                            @endif
                        </div>
                        <h4 class="mt-3 text-primary">{{ ucfirst($user->name) }}</h4>
                    </div>

                    <!-- User Details -->
                    <div class="col-md-8">
                        <div class="card shadow-sm p-3">
                            <h4 class="text-primary"><i class="bi bi-person-circle"></i> User Details</h4>
                            <hr>

                            <div class="row">
                                <div class="col-md-6">
                                    <p><strong>Full Name:</strong> {{ $user->name }} {{ $user->last_name ?? '' }}</p>
                                    <p><strong>Email ID:</strong> {{ $user->email }}</p>
                                    <p><strong>Phone:</strong> {{ $user->phone_no ?? 'N/A' }}</p>
                                </div>
                                <div class="col-md-6">
                                    <p><strong>Date of Birth:</strong>
                                        {{ $user->dob ? date('d M, Y', strtotime($user->dob)) : 'N/A' }}</p>
                                    <p><strong>Gender:</strong> {{ ucfirst($user->gender) ?? 'N/A' }}</p>
                                    <p><strong>Nationality:</strong> {{ ucfirst($user->nationality) ?? 'N/A' }}</p>
                                </div>
                            </div>

                            <p><strong>Address:</strong> {{ $user->address ?? 'N/A' }}</p>

                            <!-- Action Buttons -->
                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('user.edit', ['id' => $user->id]) }}"
                                    class="btn btn-primary btn-lg w-25"><i class="bi bi-pencil-square"></i> Edit Profile</a>
                                @if ($user->status == '1')
                                    <a href="{{ route('user.status', ['id' => $user->id, 'status' => $user->status]) }}"
                                        class="btn btn-success btn-lg w-25">
                                        <i class="bi bi-check-circle"></i> Activate Account
                                    </a>
                                @elseif($user->status == '0')
                                    <a href="{{ route('user.status', ['id' => $user->id, 'status' => $user->status]) }}"
                                        class="btn btn-danger btn-lg w-25">
                                        <i class="bi bi-check-circle"></i> Deactivate Account
                                    </a>
                                @endif
                                <a href="{{ route('user.delete', $user->id) }}" class="btn btn-danger btn-lg w-25 ms-2"><i
                                        class="bi bi-trash"></i> Delete Account</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
