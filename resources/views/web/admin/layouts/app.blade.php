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

<body>
    <div id="app">
        @include('web.admin.layouts.sidebar')
        <div id="main">
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
