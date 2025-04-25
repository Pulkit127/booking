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
                <div class="col-12">
                    <h3 class="mb-3">Good Morning, {{ auth()->user()->name }}</h3>
                    <p>Your dashboard gives you views of key performance metrics.</p>
                </div>
            </div>
    
            <!-- Key Metrics Overview -->
            <div class="row">
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <p>Today's Bookings</p>
                            <h4>0</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <p>Total Bookings</p>
                            <h4>0</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <p>Today's Users</p>
                            <h4>0</h4>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card">
                        <div class="card-body">
                            <p>Total Users</p>
                            <h4>{{ $totalUsers ?? 0 }}</h4>
                        </div>
                    </div>
                </div>
            </div>
    
            <!-- Data Visualizations -->
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Overview</h4>
                        </div>
                        <div class="card-body">
                            <div id="layout1-chart1"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Revenue vs Cost</h4>
                        </div>
                        <div class="card-body">
                            <div id="layout1-chart-2" style="min-height: 360px;"></div>
                        </div>
                    </div>
                </div>
            </div>
    
           
    
            <!-- Order Summary -->
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Order Summary</h4>
                        </div>
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="progress progress-round m-0 orange">
                                    <span class="progress-left">
                                        <span class="progress-bar"></span>
                                    </span>
                                    <span class="progress-right">
                                        <span class="progress-bar"></span>
                                    </span>
                                    <div class="progress-value">46%</div>
                                </div>
                                <div class="ml-3">
                                    <h5>$12,6598</h5>
                                    <p>Average Orders</p>
                                </div>
                            </div>
                            <div id="layout1-chart-5"></div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Page end  -->
        </div>
    </div>
@endsection
