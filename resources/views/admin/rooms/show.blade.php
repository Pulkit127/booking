@extends('admin.layouts')

@section('content')
    <div class="content-page">

        <div class="container mt-4">
            <div class="card shadow-lg p-4">
                <div class="row mt-4">
                    <!-- Room Images Carousel -->
                    <div class="col-md-6">
                        @if ($room->images->count() > 0)
                            <div id="roomCarousel" class="carousel slide" data-bs-ride="carousel">
                                <!-- Carousel Indicators -->
                                <div class="carousel-indicators">
                                    @foreach ($room->images as $key => $image)
                                        <button type="button" data-bs-target="#roomCarousel"
                                            data-bs-slide-to="{{ $key }}"
                                            class="{{ $key == 0 ? 'active' : '' }}"></button>
                                    @endforeach
                                </div>

                                <!-- Carousel Images -->
                                <div class="carousel-inner rounded shadow">
                                    @foreach ($room->images as $key => $image)
                                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                            <img src="{{ asset('public/storage/' . $image->image_path) }}"
                                                class="d-block w-100" alt="Room Image"
                                                style="height: 350px; object-fit: cover; border-radius: 10px;">
                                        </div>
                                    @endforeach
                                </div>

                                <!-- Previous & Next Controls -->
                                <button class="carousel-control-prev" type="button" data-bs-target="#roomCarousel"
                                    data-bs-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                </button>
                                <button class="carousel-control-next" type="button" data-bs-target="#roomCarousel"
                                    data-bs-slide="next">
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
                                <span
                                    class="badge {{ $room->status == 'Available' ? 'bg-success' : ($room->status == 'Booked' ? 'bg-danger' : 'bg-warning') }}">
                                    {{ $room->status }}
                                </span>
                            </p>

                            <!-- Booking Button -->
                            <div class="text-center mt-3">
                                @if ($room->status == 'Available')
                                    <button type="button" class="btn btn-primary btn-lg w-100" data-toggle="modal"
                                        data-target="#bookingModal">
                                        Book Now
                                    </button>
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


    <!-- Start Model Book Now -->
    <div class="modal fade" id="bookingModal" tabindex="-1" role="dialog" aria-labelledby="bookingModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="bookingModalLabel">New Booking</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="{{ route('booking.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="room_id" value="{{ $room->id }}">
                    <div class="modal-body">
                        <div class="row">
                            <!-- Guest Name -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Guest Name *</label>
                                    <input type="text" class="form-control" name="guest_name"
                                        placeholder="Enter guest name" required>
                                </div>
                            </div>

                            <!-- Email -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" class="form-control" name="email" placeholder="Enter email">
                                </div>
                            </div>

                            <!-- Phone Number -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Phone Number *</label>
                                    <input type="text" class="form-control" name="phone_number"
                                        placeholder="Enter phone number" required>
                                </div>
                            </div>

                            <!-- Check-in -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Check-in Date *</label>
                                    <input type="date" class="form-control" name="check_in_date" required>
                                </div>
                            </div>

                            <!-- Check-out -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Check-out Date *</label>
                                    <input type="date" class="form-control" name="check_out_date" required>
                                </div>
                            </div>

                            <!-- Number of Guests -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Number of Guests *</label>
                                    <input type="number" class="form-control" name="number_of_guests" required>
                                </div>
                            </div>

                            <!-- Payment Status -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Payment Status *</label>
                                    <select name="payment_status" class="form-control" required>
                                        <option value="Pending">Pending</option>
                                        <option value="Paid">Paid</option>
                                        <option value="Failed">Failed</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Booking Status -->
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Booking Status *</label>
                                    <select name="booking_status" class="form-control" required>
                                        <option value="Pending">Pending</option>
                                        <option value="Confirmed">Confirmed</option>
                                        <option value="Checked-in">Checked-in</option>
                                        <option value="Checked-out">Checked-out</option>
                                        <option value="Cancelled">Cancelled</option>
                                    </select>
                                </div>
                            </div>

                            <!-- Notes -->
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Notes</label>
                                    <textarea name="notes" rows="3" class="form-control" placeholder="Additional notes"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit Booking</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <!-- End Book Model -->
@endsection
