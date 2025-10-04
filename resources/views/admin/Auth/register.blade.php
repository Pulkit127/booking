<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up - Online Shopping</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/images/shop-ico.png') }}">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/backend-plugin.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/backende209.css?v=1.0.0') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/@fortawesome/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/line-awesome/dist/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/vendor/remixicon/fonts/remixicon.css') }}">

    <style>
        body {
            background: #f7f8fa;
        }

        .auth-card {
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.07);
        }

        .form-control {
            border-radius: 12px;
            padding: 0.75rem 1rem;
        }

        .btn-primary {
            border-radius: 12px;
            padding: 0.6rem 2rem;
            font-weight: 600;
            background-color: #3f51b5;
        }

        .btn-primary:hover {
            background-color: #303f9f;
        }

        .custom-checkbox .custom-control-label::before {
            border-radius: 4px;
        }

        .image-right {
            padding: 2rem;
            max-width: 100%;
        }

        .alert {
            border-radius: 12px;
        }
    </style>
</head>

<body>
    <!-- loader Start -->
    <div id="loading">
        <div id="loading-center"></div>
    </div>
    <!-- loader END -->

    <div class="wrapper">
        <section class="login-content">
            <div class="container">
                <div class="row justify-content-center align-items-center vh-100">
                    <div class="col-lg-10">
                        <div class="card auth-card">
                            <div class="row no-gutters">
                                <div class="col-md-6 p-4">
                                    <h2 class="mb-3">Sign Up</h2>
                                    <p class="text-muted">Create your account</p>

                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul class="mb-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <form method="POST" action="{{ route('register') }}">
                                        @csrf
                                        <div class="form-row">
                                            <div class="form-group col-md-6">
                                                <label for="name">First Name</label>
                                                <input type="text" name="name" id="name" class="form-control" required>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="last_name">Last Name</label>
                                                <input type="text" name="last_name" id="last_name" class="form-control" required>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="email">Email</label>
                                                <input type="email" name="email" id="email" class="form-control" required>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="phone_no">Phone Number</label>
                                                <input type="text" name="phone_no" id="phone_no" class="form-control" required>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="password">Password</label>
                                                <input type="password" name="password" id="password" class="form-control" required>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <label for="password_confirmation">Confirm Password</label>
                                                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
                                            </div>

                                            <div class="form-group col-12">
                                                <div class="custom-control custom-checkbox">
                                                    <input type="checkbox" class="custom-control-input" id="terms" name="terms" required>
                                                    <label class="custom-control-label" for="terms">I agree with the <a href="#">terms of use</a></label>
                                                </div>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-primary w-100 mt-3">Sign Up</button>
                                        <p class="text-center mt-3">
                                            Already have an account? <a href="{{ route('login') }}" class="text-primary">Sign In</a>
                                        </p>
                                    </form>
                                </div>
                                <div class="col-md-6 bg-light d-flex align-items-center justify-content-center">
                                    <img src="{{ asset('assets/images/login/01.png') }}" alt="Sign Up Illustration" class="image-right">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('assets/js/backend-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/table-treeview.js') }}"></script>
    <script src="{{ asset('assets/js/customizer.js') }}"></script>
    <script src="{{ asset('assets/js/chart-custom.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>
</body>

</html>
