<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Mazer Admin Dashboard</title>

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/dashboard/dist/assets/css/bootstrap.css">

    <!-- Perbaikan: Ganti simple-datatables dengan DataTables -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

    <link rel="stylesheet" href="/dashboard/dist/assets/vendors/iconly/bold.css">
    <link rel="stylesheet" href="/dashboard/dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.css">
    <link rel="stylesheet" href="/dashboard/dist/assets/vendors/bootstrap-icons/bootstrap-icons.css">
    <link rel="stylesheet" href="/dashboard/dist/assets/css/app.css">
    <link rel="shortcut icon" href="/dashboard/dist/assets/images/favicon.svg" type="image/x-icon">
</head>

       <style>
        :root {
            --bs-primary: #378d4c;
            --bs-primary-rgb: 55, 141, 76;
        }

        .bg-primary {
            background-color: #378d4c !important;
        }

        .bg-primary-subtle {
            background-color: rgba(55, 141, 76, 0.1) !important;
        }

        .text-primary {
            color: #378d4c !important;
        }

        .btn-primary {
            background-color: #378d4c !important;
            border-color: #378d4c !important;
        }

        .btn-primary:hover, .btn-primary:focus, .btn-primary:active {
            background-color: #2c7a3f !important;
            border-color: #2c7a3f !important;
        }

        .btn-outline-primary {
            color: #378d4c !important;
            border-color: #378d4c !important;
        }

        .btn-outline-primary:hover, .btn-outline-primary:focus, .btn-outline-primary:active {
            background-color: #378d4c !important;
            color: #fff !important;
        }

        .border-primary {
            border-color: #378d4c !important;
        }

        a {
            color: #378d4c;
        }

        a:hover {
            color: #2c7a3f;
        }

        .sidebar-item.active {
            background-color: #378d4c !important;
        }

        .sidebar-item.active .sidebar-link {
            background-color: #378d4c !important;
        }

        .sidebar-item.active::before {
            background-color: #378d4c !important;
        }

        .form-check-input:checked {
            background-color: #378d4c !important;
            border-color: #378d4c !important;
        }

        .page-item.active .page-link {
            background-color: #378d4c !important;
            border-color: #378d4c !important;
        }

        .nav-pills .nav-link.active, .nav-pills .show>.nav-link {
            background-color: #378d4c !important;
        }

        .form-select:focus, .form-control:focus {
            border-color: #93c7a0 !important;
            box-shadow: 0 0 0 0.25rem rgba(55, 141, 76, 0.25) !important;
        }

        /* Perbaikan untuk menghilangkan area putih di bawah footer */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
            background-color: #cfe7cf !important;
        }

        #app {
            min-height: 100vh;
            display: flex;
            background-color: #cfe7cf !important;
        }

        #main {
            flex: 1;
            display: flex;
            flex-direction: column;
            background-color: #cfe7cf !important;
        }

        /* Pastikan content area mengisi ruang yang tersisa */
        .content-wrapper {
            flex: 1;
            background-color: #cfe7cf !important;
        }

        /* Style untuk footer agar selalu di bawah */
        .footer {
            margin-top: auto;
            background-color: #cfe7cf !important;
        }
    </style>

<body style="background-color: #cfe7cf !important;">
     <div id="app" style="background-color: #cfe7cf;">
        @include('web.admin.layouts.sidebar')
        <div id="main" style="background-color: #cfe7cf;">
            @include('web.admin.layouts.header')

            @yield('content')

            @include('web.admin.layouts.footer')
        </div>
    </div>
    <script src="/dashboard/dist/assets/vendors/perfect-scrollbar/perfect-scrollbar.min.js"></script>
    <script src="/dashboard/dist/assets/js/bootstrap.bundle.min.js"></script>

    <!-- Perbaikan: Tambahkan jQuery (diperlukan oleh DataTables) -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

    <!-- Perbaikan: Ganti simple-datatables dengan DataTables -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>


    <script src="/dashboard/dist/assets/vendors/apexcharts/apexcharts.js"></script>
    <script src="/dashboard/dist/assets/js/pages/dashboard.js"></script>
    <script src="/dashboard/dist/assets/js/main.js"></script>

    @yield('scripts')
</body>

</html>
