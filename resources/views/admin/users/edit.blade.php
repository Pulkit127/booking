@extends('admin.layouts')

@section('content')
    <div class="content-page">
        <div class="container mt-4">
            <div class="card shadow-lg p-4">
                <h4 class="text-primary"><i class="bi bi-pencil-square"></i> Edit Profile</h4>
                <hr>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <!-- Profile Picture -->
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

                            <div class="mt-3">
                                <label class="btn btn-outline-primary">
                                    <input type="file" name="profile_picture" hidden> Change Profile Picture
                                </label>
                            </div>
                        </div>

                        <!-- User Details -->
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Display Name</label>
                                        <input type="text" name="display_name" class="form-control"
                                            value="{{ old('display_name', $user->display_name) }}" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input type="text" name="name" class="form-control"
                                            value="{{ old('name', $user->name) }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input type="text" name="last_name" class="form-control"
                                            value="{{ old('last_name', $user->last_name) }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="email" class="form-control"
                                            value="{{ old('email', $user->email) }}" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Phone</label>
                                        <input type="text" name="phone_no" class="form-control"
                                            value="{{ old('phone_no', $user->phone_no) }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Date of Birth</label>
                                        <input type="date" name="dob" class="form-control"
                                            value="{{ old('dob', $user->dob) }}">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <select name="gender" class="form-control">
                                            <option value="Male" {{ $user->gender == 'Male' ? 'selected' : '' }}>Male
                                            </option>
                                            <option value="Female" {{ $user->gender == 'Female' ? 'selected' : '' }}>Female
                                            </option>
                                            <option value="Other" {{ $user->gender == 'Other' ? 'selected' : '' }}>Other
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Nationality</label>
                                        <input type="text" name="nationality" class="form-control"
                                            value="{{ old('nationality', $user->nationality) }}">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Address</label>
                                        <textarea name="address" class="form-control" rows="3">{{ old('address', $user->address) }}</textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-4">
                                <button type="submit" class="btn btn-primary w-100"><i class="bi bi-check-circle"></i> Save
                                    Changes</button>
                                <a href="{{ route('user.show', ['id' => $user->id]) }}"
                                    class="btn btn-secondary w-100 mt-2"><i class="bi bi-arrow-left"></i> Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
