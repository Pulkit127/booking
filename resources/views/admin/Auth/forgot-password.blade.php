<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Online Shopping - Reset Password</title>

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
            background: linear-gradient(to right, #f3f4f6, #fff);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .auth-card {
            border-radius: 16px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            overflow: hidden;
        }

        .auth-content {
            display: flex;
            align-items: center;
            padding: 2rem;
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
            border: none;
        }

        .btn-primary:hover {
            background-color: #303f9f;
        }

        .image-right {
            max-width: 100%;
            padding: 2rem;
        }

        .alert {
            border-radius: 12px;
            padding: 1rem;
        }

        .form-group label {
            font-weight: 500;
        }
    </style>
</head>

<body>

    <div class="wrapper">
        <section class="login-content">
            <div class="container">
                <div class="row justify-content-center align-items-center vh-100">
                    <div class="col-md-10 col-lg-8">
                        <div class="card auth-card">
                            <div class="row no-gutters">
                                <div class="col-md-6 p-4">
                                    <h2 class="mb-3">Reset Password</h2>
                                    <p class="mb-4 text-muted">Enter your email and we'll send reset instructions.</p>

                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul class="mb-0">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    @if (session('success'))
                                        <div class="alert alert-success">{{ session('success') }}</div>
                                    @elseif(session('error'))
                                        <div class="alert alert-danger">{{ session('error') }}</div>
                                    @endif

                                    <form method="POST" action="{{ route('password.email') }}">
                                        @csrf
                                        <div class="form-group">
                                            <label for="email">Email Address</label>
                                            <input type="email" id="email" name="email" class="form-control" placeholder="example@email.com" required>
                                        </div>

                                        <button type="submit" class="btn btn-primary w-100 mt-4">Send Reset Link</button>
                                    </form>
                                </div>
                                <div class="col-md-6 bg-light d-flex align-items-center justify-content-center">
                                    <img src="{{ asset('assets/images/login/01.png') }}" alt="Reset Illustration" class="image-right">
                                </div>
                            </div>
                        </div>
                        {{-- <p class="text-center mt-3">
                            Go back to <a href="{{ route('login') }}" class="text-primary">Login</a>
                        </p> --}}
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
