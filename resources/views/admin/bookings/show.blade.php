@extends('admin.layouts')

@section('content')
<div class="content-page">
    <div class="container mt-4">
        <div class="card shadow-lg p-4">
            <h4 class="text-primary mb-3">Booking Details</h4>
            <hr>

            <div class="row">
                <!-- Left Info -->
                <div class="col-md-6">
                    <p><strong>Guest Name:</strong> {{ $booking->guest_name }}</p>
                    <p><strong>Email:</strong> {{ $booking->email ?? 'N/A' }}</p>
                    <p><strong>Phone Number:</strong> {{ $booking->phone_number }}</p>
                    <p><strong>Room Booked:</strong> {{ $booking->room->name }}</p>
                    <p><strong>Room Type:</strong> {{ $booking->room->roomType->name ?? 'N/A' }}</p>
                    <p><strong>Price Per Night:</strong> {{ $booking->price_per_night }}</p>
                </div>

                <!-- Right Info -->
                <div class="col-md-6">
                    <p><strong>Check-In Date:</strong> {{ $booking->check_in_date }}</p>
                    <p><strong>Check-Out Date:</strong> {{ $booking->check_out_date }}</p>
                    <p><strong>No. of Guests:</strong> {{ $booking->number_of_guests }}</p>
                    <p><strong>Payment Status:</strong> 
                        <span class="badge bg-{{ $booking->payment_status == 'Paid' ? 'success' : ($booking->payment_status == 'Pending' ? 'warning' : 'danger') }}">
                            {{ $booking->payment_status }}
                        </span>
                    </p>
                    <p><strong>Booking Status:</strong> 
                        <span class="badge bg-{{ $booking->booking_status == 'Confirmed' ? 'primary' : ($booking->booking_status == 'Pending' ? 'warning' : 'secondary') }}">
                            {{ $booking->booking_status }}
                        </span>
                    </p>
                    <p><strong>Total Price:</strong> {{ $booking->total_price }}</p>
                </div>
            </div>

            @if ($booking->notes)
                <div class="mt-3">
                    <p><strong>Notes:</strong> {{ $booking->notes }}</p>
                </div>
            @endif

            <div class="text-end mt-4">
                <a href="{{ route('booking.index') }}" class="btn btn-secondary">Back to List</a>
            </div>
        </div>
    </div>
</div>
@endsection
