@extends('admin.layouts')
@section('content')
    <div class="content-page">
        <div class="container-fluid">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <div class="d-flex flex-wrap align-items-center justify-content-between mb-4">
                        <div>
                            <h4 class="mb-3">Bookings List</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="table-responsive rounded mb-3">
                        <table class="data-table table mb-0 tbl-server-info">
                            <thead class="bg-white text-uppercase">
                                <tr class="ligth ligth-data">
                                    <th>ID</th>
                                    <th>Guest Name</th>
                                    <th>Room</th>
                                    <th>Dates</th>
                                    <th>Guests</th>
                                    <th>Status</th>
                                    <th>Payment</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="ligth-body">
                                @foreach ($bookings as $booking)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $booking->guest_name }}</td>
                                        <td>{{ $booking->room->name }}</td>
                                        <td>{{ date('d-M-Y', strtotime($booking->check_in_date)) }} to {{ date('d-M-Y', strtotime($booking->check_out_date)) }}</td>
                                        <td>{{ $booking->number_of_guests }}</td>
                                        <td>
                                            <span class="badge badge-info">{{ $booking->booking_status }}</span>
                                        </td>
                                        <td>{{ $booking->payment_status }}</td>
                                        <td>
                                            <a class="badge badge-info mr-2" data-toggle="tooltip" data-placement="top"
                                                    title="" data-original-title="View"
                                                    href="{{ route('booking.show', ['id' => $booking->id]) }}"><i
                                                        class="ri-eye-line mr-0"></i></a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- Page end  -->
        </div>
    </div>
@endsection
