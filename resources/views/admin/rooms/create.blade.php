@extends('admin.layouts')
@section('content')
    <div class="content-page">
        <div class="container-fluid add-form-list">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between">
                            <div class="header-title">
                                <h4 class="card-title">Create Room</h4>
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
                            <form action="{{ route('room.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Room Number</label>
                                            <input type="text" class="form-control" placeholder="Enter Room Number"
                                                name="room_number">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Room Name</label>
                                            <input type="text" class="form-control" name="name" placeholder="E.g., Deluxe Room">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Room Type</label>
                                            <select class="form-control" name="room_type">
                                                @foreach ($roomTypes as $type)
                                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Price Per Night</label>
                                            <input type="text" class="form-control" placeholder="Enter Price Per Night"
                                                name="price_per_night">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Capacity</label>
                                            <input type="text" class="form-control" placeholder="Enter Capacity"
                                                name="capacity">
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Bed Type</label>
                                            <select class="form-control" name="bed_type">
                                                <option value="Single Bed">Single Bed</option>
                                                <option value="Twin Beds">Twin Beds</option>
                                                <option value="Double Bed">Double Bed</option>
                                                <option value="Queen Bed">Queen Bed</option>
                                                <option value="King Bed">King Bed</option>
                                                <option value="Super King Bed">Super King Bed</option>
                                                <option value="Bunk Beds">Bunk Beds</option>
                                                <option value="Sofa Bed">Sofa Bed</option>
                                                <option value="Murphy Bed">Murphy Bed</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <select name="status" class="form-control">
                                                <option value="Available">Available</option>
                                                <option value="Booked">Booked</option>
                                                <option value="Under Maintenance">Under Maintenance</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Image</label>
                                            <input type="file" name="images[]" class="form-control" multiple>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Description</label>
                                            <textarea name="description" class="form-control" rows="3"
                                                placeholder="Enter Description"></textarea> 
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary mr-2">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page end  -->
        </div>
    </div>
@endsection
