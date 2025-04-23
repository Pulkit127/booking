<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Online Shopping</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('public/assets/images/shop-ico.png') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/css/backende209.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/vendor/%40fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet"
        href="{{ asset('public/assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/assets/vendor/remixicon/fonts/remixicon.css') }}">
</head>

<body class=" ">
    <!-- loader Start -->
    <div id="loading">
        <div id="loading-center">
        </div>
    </div>
    <!-- loader END -->

    <div class="wrapper">
        <section class="login-content">
            <div class="container">
                <div class="row align-items-center justify-content-center height-self-center">
                    <div class="col-lg-8">
                        <div class="card auth-card">
                            <div class="card-body p-0">
                                <div class="d-flex align-items-center auth-content">
                                    <div class="col-lg-7 align-self-center">
                                        <div class="p-3">
                                            <h2 class="mb-2">Change Password</h2>
                                            <p>Enter your New Password</p>
                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul>
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif
                                            <form method="post" action="{{ route('change-password') }}">
                                                @csrf
                                                <input type="hidden" name="resetlink" value="{{ $resetlink }}">      
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="floating-label form-group">
                                                            <input class="floating-input form-control" type="password"
                                                                placeholder=" " name="password">
                                                            <label>New Password</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="floating-label form-group">
                                                            <input class="floating-input form-control" type="password"
                                                                placeholder=" " name="password_confirmation">
                                                            <label>Confirm Password</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="col-lg-5 content-right">
                                        <img src="{{ asset('public/assets/images/login/01.png') }}"
                                            class="img-fluid image-right" alt="">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Backend Bundle JavaScript -->
    <script src="{{ asset('public/assets/js/backend-bundle.min.js') }}"></script>

    <!-- Table Treeview JavaScript -->
    <script src="{{ asset('public/assets/js/table-treeview.js') }}"></script>

    <!-- Chart Custom JavaScript -->
    <script src="{{ asset('public/assets/js/customizer.js') }}"></script>

    <!-- Chart Custom JavaScript -->
    <script async src="{{ asset('public/assets/js/chart-custom.js') }}"></script>

    <!-- app JavaScript -->
    <script src="{{ asset('public/assets/js/app.js') }}"></script>
</body>

</html>
