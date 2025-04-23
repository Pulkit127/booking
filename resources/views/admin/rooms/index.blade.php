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
                            <h4 class="mb-3">Rooms List</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="table-responsive rounded mb-3">
                        <table class="data-table table mb-0 tbl-server-info">
                            <thead class="bg-white text-uppercase">
                                <tr class="ligth ligth-data">
                                    <th>ID</th>
                                    <th>Room Number</th>
                                    <th>Room Name</th>
                                    <th>Room Type</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody class="ligth-body">
                                @foreach ($rooms as $room)
                                    <tr>
                                        <td>{{ $room->id }}</td>
                                        <td>{{ $room->room_number }}</td>
                                        <td>{{ $room->name }}</td>
                                        <td>{{ $room->roomType->name }}</td>
                                        <td>₹{{ $room->price_per_night }}</td>
                                        <td>{{ $room->status }}</td>
                                        <td>
                                            <div class="d-flex align-items-center list-action">
                                                <a class="badge badge-info mr-2" data-toggle="tooltip" data-placement="top"
                                                    title="" data-original-title="View"
                                                    href="{{ route('room.show', ['id' => $room->id]) }}"><i
                                                        class="ri-eye-line mr-0"></i></a>
                                                <a class="badge bg-success mr-2" data-toggle="tooltip" data-placement="top"
                                                    title="" data-original-title="Edit"
                                                    href="{{ route('room.edit', ['id' => $room->id]) }}"><i
                                                        class="ri-pencil-line mr-0"></i></a>
                                                <a class="badge bg-warning mr-2" data-toggle="tooltip" data-placement="top"
                                                    title="" data-original-title="Delete"
                                                    href="{{ route('room.destroy', ['id' => $room->id]) }}"><i
                                                        class="ri-delete-bin-line mr-0"></i></a>
                                            </div>
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
