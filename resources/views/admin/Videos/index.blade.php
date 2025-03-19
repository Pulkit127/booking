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
                            <h4 class="mb-3">Videos List</h4>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="table-responsive rounded mb-3">
                        <table class="data-table table mb-0 tbl-server-info">
                            <thead class="bg-white text-uppercase">
                                <tr class="ligth ligth-data">
                                    <th>Sr no.</th>
                                    <th>Category Name</th>
                                    <th>Title</th>
                                    <th>Url</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody class="ligth-body">
                                @foreach ($videos as $video)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $video->category->name ?? '' }}</td> 
                                        <td>{{ $video->title ?? '' }}</td>
                                        <td>
                                            <iframe src="{{ asset('public/storage/' . $video->url) }}" title="{{ $video->title ?? '' }}"></iframe>
                                        </td>
                                        <td>{{ $video->created_at->format('d-m-Y') }}</td>
                                        <td>
                                            <div class="d-flex align-items-center list-action">
                                                <a class="badge bg-warning mr-2" data-toggle="tooltip" data-placement="top"
                                                    title="" data-original-title="Delete"
                                                    href="{{ route('video.delete', ['id' => $video->id]) }}"><i
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
