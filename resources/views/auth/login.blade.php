<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Agfa School</title>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/dashboard/dist/assets/css/bootstrap.css">
    <link rel="stylesheet" href="/dashboard/dist/assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="/dashboard/dist/assets/css/app.css">
    <link rel="stylesheet" href="/dashboard/dist/assets/css/pages/auth.css">
    <style>
        /* Custom Warna Hijau */
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
    </style>
</head>

<body>
    <div id="auth">
        <div class="row h-100">
            <div class="col-lg-5 col-12">
                <div id="auth-left">
                    <div class="auth-logo">
                        <a href="{{ url('/') }}">
                            <img src="/agfa-logo.png" alt="Logo" class="auth-logo-img">
                        </a>
                    </div>

                    <style>
                        .auth-logo-img {
                        max-width: 500px;
                        width: 25%;
                        height: auto;
                    }

                    /* Responsive untuk mobile */
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
                    </style>
                    <h1 class="auth-title">Log in</h1>
                    <p class="auth-subtitle mb-5">Log in with your credentials.</p>

                    <!-- Laravel Login Form -->
                    <form action="{{ route('login') }}" method="POST">
                        @csrf
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="email" name="email" class="form-control form-control-xl" placeholder="Email" required>
                            <div class="form-control-icon">
                                <i class="bi bi-envelope"></i>
                            </div>
                        </div>
                        <div class="form-group position-relative has-icon-left mb-4">
                            <input type="password" name="password" class="form-control form-control-xl" placeholder="Password" required>
                            <div class="form-control-icon">
                                <i class="bi bi-shield-lock"></i>
                            </div>
                        </div>
                        <div class="form-check form-check-lg d-flex align-items-end">
                            <input class="form-check-input me-2" type="checkbox" name="remember" id="flexCheckDefault">
                            <label class="form-check-label text-gray-600" for="flexCheckDefault">
                                Keep me logged in
                            </label>
                        </div>
                        <button class="btn btn-custom btn-block btn-lg shadow-lg mt-5" type="submit">Log in</button>
                    </form>

                    <!-- Error Handling -->
                    @if ($errors->any())
                        <div class="alert alert-danger mt-3">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="text-center mt-5 text-lg fs-4">
                        <p class="text-gray-600">Don't have an account?
                            <a href="{{ route('register') }}" class="font-bold">Sign up</a>.
                        </p>
                        <p>
                            <a class="font-bold" href="{{ route('password.request') }}">Forgot password?</a>.
                        </p>
                    </div>
                </div>
            </div>
           <div class="col-lg-7 d-none d-lg-block" style="background-color: rgba(255, 255, 255, 0.659);">
                <div id="auth-kanan" class="h-100 d-flex align-items-center justify-content-center p-4">
                    <img src="/Mobile-login-Cristina-removebg-preview.png"
                         alt="Login Image"
                         class="img-fluid"
                         style="max-height: 80vh; width: auto; object-fit: contain;">
                </div>
            </div>
        </div>
    </div>
</body>
</html>
