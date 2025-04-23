<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Room;
use App\Models\Booking;
use App\Http\Requests\BookingRequest;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('room')->latest()->paginate(10);
        return view('admin.bookings.index', compact('bookings'));
    }

    public function create()
    {
        $rooms = Room::all();
        return view('admin.bookings.create', compact('rooms'));
    }

    public function store(BookingRequest $request)
    {
        $data =  $request->validated();

        // Get price per night and calculate total price
        $price_per_night = $this->getRoomPrice($data['room_id']);

        // Calculate total price if not provided
        if (empty($request->total_price)) {
            $data['total_price'] = $this->calculateTotalPrice($data['check_in_date'], $data['check_out_date'], $price_per_night);
            $data['price_per_night'] = $price_per_night;
        }

        Booking::create($data);
        return redirect()->route('booking.index')->with('success', 'Booking created successfully');
    }

    // Function to get the price_per_night based on room_id
    private function getRoomPrice($room_id)
    {
        $room = Room::find($room_id);
        return $room ? $room->price_per_night : 0;  // Default to 0 if room is not found
    }

    // Function to calculate total price based on dates and price per night
    private function calculateTotalPrice($check_in_date, $check_out_date, $price_per_night)
    {
        $checkInDate = Carbon::parse($check_in_date);
        $checkOutDate = Carbon::parse($check_out_date);
        $nights = $checkInDate->diffInDays($checkOutDate);
        return $price_per_night * $nights;
    }

    public function show()
    {
        $id = request('id');
        $booking = Booking::with('room')->findOrFail($id);
        return view('admin.bookings.show', compact('booking'));
    }
}
