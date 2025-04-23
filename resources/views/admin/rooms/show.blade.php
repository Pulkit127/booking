@extends('admin.layouts')

@section('content')
<div class="content-page">

<div class="container mt-4">
    <div class="card shadow-lg p-4">        
        <div class="row mt-4">
            <!-- Room Images Carousel -->
            <div class="col-md-6">
                @if($room->images->count() > 0)
                    <div id="roomCarousel" class="carousel slide" data-bs-ride="carousel">
                        <!-- Carousel Indicators -->
                        <div class="carousel-indicators">
                            @foreach ($room->images as $key => $image)
                                <button type="button" data-bs-target="#roomCarousel" data-bs-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}"></button>
                            @endforeach
                        </div>
                        
                        <!-- Carousel Images -->
                        <div class="carousel-inner rounded shadow">
                            @foreach ($room->images as $key => $image)
                                <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                    <img src="{{ asset('public/storage/' . $image->image_path) }}" class="d-block w-100" alt="Room Image" style="height: 350px; object-fit: cover; border-radius: 10px;">
                                </div>
                            @endforeach
                        </div>

                        <!-- Previous & Next Controls -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#roomCarousel" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#roomCarousel" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        </button>
                    </div>
                @else
                    <p class="text-muted">No images available</p>
                @endif
            </div>

            <!-- Room Details -->
            <div class="col-md-6">
                <div class="card shadow-sm p-3">
                    <h4 class="text-primary">Room Details</h4>
                    <hr>
                    <p><strong>Room Name:</strong> {{ ucfirst($room->name) }}</p>
                    <p><strong>Room Type:</strong> {{ ucfirst($room->roomType->name) }}</p>
                    <p><strong>Description:</strong> {{ $room->description }}</p>
                    <p><strong>Price per Night:</strong> ₹{{ number_format($room->price_per_night, 2) }}</p>
                    <p><strong>Capacity:</strong> {{ $room->capacity }} Guests</p>
                    <p><strong>Bed Type:</strong> {{ ucfirst($room->bed_type) }}</p>
                    <p><strong>Status:</strong> 
                        <span class="badge {{ $room->status == 'Available' ? 'bg-success' : ($room->status == 'Booked' ? 'bg-danger' : 'bg-warning') }}">
                            {{ $room->status }}
                        </span>
                    </p>

                    <!-- Booking Button -->
                    <div class="text-center mt-3">
                        @if($room->status == 'Available')
                            <a href="#" class="btn btn-primary btn-lg w-100">Book Now</a>
                        @else
                            <button class="btn btn-secondary btn-lg w-100" disabled>Not Available</button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
