@extends('admin.layouts')

@section('content')
    <div class="content-page">
        <div class="container-fluid add-form-list">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card shadow-lg">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Edit Room</h4>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('room.update', $room->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <!-- Room Number -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Room Number</label>
                                            <input type="text" class="form-control" readonly name="room_number" value="{{ old('room_number', $room->room_number) }}" required>
                                        </div>
                                    </div>

                                    <!-- Room Type -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Room Type</label>
                                            <select class="form-control" name="room_type">
                                                @foreach ($roomTypes as $type)
                                                    <option value="{{ $type->id }}" {{ $room->room_type == $type->id ? 'selected' : '' }}>
                                                        {{ $type->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Price Per Night -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Price Per Night</label>
                                            <input type="text" class="form-control" name="price_per_night" value="{{ old('price_per_night', $room->price_per_night) }}" required>
                                        </div>
                                    </div>

                                    <!-- Capacity -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Capacity</label>
                                            <input type="number" class="form-control" name="capacity" value="{{ old('capacity', $room->capacity) }}" required>
                                        </div>
                                    </div>

                                    <!-- Bed Type -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Bed Type</label>
                                            <select class="form-control" name="bed_type">
                                                @php
                                                    $bedTypes = ['Single Bed', 'Twin Beds', 'Double Bed', 'Queen Bed', 'King Bed', 'Super King Bed', 'Bunk Beds', 'Sofa Bed', 'Murphy Bed'];
                                                @endphp
                                                @foreach ($bedTypes as $bed)
                                                    <option value="{{ $bed }}" {{ $room->bed_type == $bed ? 'selected' : '' }}>
                                                        {{ $bed }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Status -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="status" class="form-control">
                                                <option value="Available" {{ $room->status == 'Available' ? 'selected' : '' }}>Available</option>
                                                <option value="Booked" {{ $room->status == 'Booked' ? 'selected' : '' }}>Booked</option>
                                                <option value="Under Maintenance" {{ $room->status == 'Under Maintenance' ? 'selected' : '' }}>Under Maintenance</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- Image Upload -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Upload New Images</label>
                                            <input type="file" name="images[]" class="form-control" multiple>
                                        </div>
                                    </div>

                                    <!-- Existing Images -->
                                    <div class="col-md-12">
                                        <label>Current Images:</label>
                                        <div class="d-flex flex-wrap">
                                            @foreach ($room->images as $image)
                                                <div class="position-relative me-2 mb-2">
                                                    <img src="{{ asset('public/storage/' . $image->image_path) }}" alt="Room Image" class="img-thumbnail" style="width: 100px; height: 100px;">
                                                    <button type="button" class="btn btn-sm btn-danger position-absolute top-0 end-0" onclick="deleteImage('{{ $image->id }}')">X</button>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>

                                    <!-- Description -->
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea name="description" class="form-control" rows="3">{{ old('description', $room->description) }}</textarea>
                                        </div>
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="col-md-12 text-center">
                                        <button type="submit" class="btn btn-success btn-lg">Update Room</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript to handle image deletion -->
    <script>
        function deleteImage(imageId) {
            if (confirm('Are you sure you want to delete this image?')) {
                fetch('{{ route("room.deleteImage") }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({ image_id: imageId })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Failed to delete image.');
                    }
                });
            }
        }
    </script>
@endsection
