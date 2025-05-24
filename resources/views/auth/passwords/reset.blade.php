
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Mazer Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('dashboard/dist/assets/css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/dist/assets/vendors/bootstrap-icons/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/dist/assets/css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('dashboard/dist/assets/css/pages/auth.css') }}">

    <style>
        body {
            background-color: #cfe7cf !important;
        }
        .btn-custom {
            background-color: #2d6a4f;
            border-color: #2d6a4f;
            color: white;
        }
        .btn-custom:hover {
            background-color: #245d43;
            border-color: #245d43;
        }
        .auth-logo-img {
            max-width: 500px;
            width: 25%;
            height: auto;
        }
        @media (max-width: 768px) {
            .auth-logo-img {
                max-width: 300px;
            }
        }
        @media (max-width: 576px) {
            .auth-logo-img {
                max-width: 250px;
            }
        }
        .alert-success {
            border-left: 4px solid #2d6a4f;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }
        .alert-danger {
            border-left: 4px solid #dc3545;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }
    </style>
</head>
<body>
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="{{ url('/') }}">
                            <img src="{{ asset('agfa-logo.png') }}" alt="Logo" class="auth-logo-img">
                        </a>
                    </div>

                    <h1 class="auth-title">{{ __('Reset Password') }}</h1>
                    <p class="auth-subtitle mb-5">Create your new password</p>

                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-2"></i>
                            {{ session('status') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.update') }}">
                        @csrf
                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group position-relative has-icon-left mb-4">
                            <input id="email" type="email"
                                   class="form-control form-control-xl @error('email') is-invalid @enderror"
                                   name="email"
                                   value="{{ $email ?? old('email') }}"
                                   placeholder="Email"
                                   required
                                   autocomplete="email"
                                   autofocus
                                   readonly>
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                            @error('email')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group position-relative has-icon-left mb-4">
                            <input id="password" type="password"
                                   class="form-control form-control-xl @error('password') is-invalid @enderror"
                                   name="password"
                                   placeholder="New Password"
                                   required
                                   autocomplete="new-password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                            @error('password')
                                <div class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </div>
                            @enderror
                        </div>

                        <div class="form-group position-relative has-icon-left mb-4">
                            <input id="password-confirm" type="password"
                                   class="form-control form-control-xl"
                                   name="password_confirmation"
                                   placeholder="Confirm Password"
                                   required
                                   autocomplete="new-password">
                            <div class="form-control-icon">
                                <i class="bi bi-shield-check"></i>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-custom btn-block btn-lg shadow-lg mt-5">
                            <i class="bi bi-arrow-clockwise me-2"></i>
                            {{ __('Reset Password') }}
                        </button>
                    </form>

                    <div class="text-center mt-5 text-lg fs-4">
                        <p class="text-gray-600">
                            Remember your password?
                            <a href="{{ route('login') }}" class="font-bold">Login here</a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 d-none d-lg-block" style="background-color: rgba(255, 255, 255, 0.659);">
                <div id="auth-kanan" class="h-100 d-flex align-items-center justify-content-center p-4">
                    <img src="{{ asset('3275434-removebg-preview.png') }}"
                         alt="Login Image"
                         class="img-fluid"
                         style="max-height: 80vh; width: auto; object-fit: contain;">
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>

