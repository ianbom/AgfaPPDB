<div id="sidebar" class="active">
    <div class="sidebar-wrapper active" style="background-color: #2d753f; border-radius: 0 16px 16px 0; overflow: hidden;">
        <div class="sidebar-header">
            <div class="d-flex justify-content-between">
                <div class="logo">
                    <a href="index.html"><img src="/dashboard/dist/assets/images/logo/logo.png" alt="Logo" srcset=""></a>
                </div>
                <div class="toggler">
                    <a href="#" class="sidebar-hide d-xl-none d-block"><i class="bi bi-x bi-middle"></i></a>
                </div>
            </div>
        </div>
        <div class="sidebar-menu">
            <ul class="menu">
                <li class="sidebar-title">Profile</li>

                <li class="sidebar-item {{ Request::is('orangtua/profile*') ? 'active' : '' }}">
                    <a href="{{ route('orangtua.profile.index') }}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Profile</span>
                    </a>
                </li>

                <li class="sidebar-title">Seleksi dan Pemberkasan</li>

                <li class="sidebar-item {{ Request::is('orangtua/pemberkasan*') ? 'active' : '' }}">
                    <a href="{{ route('orangtua.pemberkasan.index') }}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Pemberkasan</span>
                    </a>
                </li>

                <li class="sidebar-item {{ Request::is('orangtua/seleksi*') ? 'active' : '' }}">
                    <a href="{{ route('orangtua.seleksi.index') }}" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span>Seleksi</span>
                    </a>
                </li>

                <li class="sidebar-title">Logout</li>

                <li class="sidebar-item">
                    <form id="logoutForm" action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-link logout-btn sidebar-link" id="logoutButton" style="text-decoration: none; color: inherit;">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Logout</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>

<style>
/* Set all text in sidebar to white */
#sidebar {
    color: #cfe7cf !important;
}

/* Add rounded corners to sidebar */
#sidebar .sidebar-wrapper {
    border-radius: 0 16px 16px 0 !important;
    box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
}

/* Round the items inside the sidebar */
#sidebar .sidebar-item {
    border-radius: 8px;
    margin: 0 8px;
}

#sidebar .sidebar-link {
    border-radius: 8px;
}

#sidebar .logout-btn {
    border-radius: 8px;
}

/* Ensure content stays within the rounded container */
#sidebar .sidebar-menu {
    padding: 0 8px;
}

#sidebar .sidebar-title {
    color: white !important;
    opacity: 0.8;
    padding-left: 8px;
}

#sidebar .sidebar-link,
#sidebar .sidebar-link i,
#sidebar .sidebar-link span {
    color: white !important;
}

#sidebar .logout-btn,
#sidebar .logout-btn i,
#sidebar .logout-btn span {
    color: white !important;
}

/* Yellow hover effect for sidebar items */
#sidebar .sidebar-item:hover {
    background-color: #FEBA17 !important;
}

#sidebar .sidebar-link:hover {
    background-color: #FEBA17 !important;
}

#sidebar .sidebar-link:hover i,
#sidebar .sidebar-link:hover span {
    color: #ffffff !important; /* White text on yellow background for better contrast */
}

#sidebar .logout-btn:hover {
    background-color: #FEBA17 !important;
}

#sidebar .logout-btn:hover i,
#sidebar .logout-btn:hover span {
    color: #2d753f !important;
}

/* Make sure active items retain their style */
#sidebar .sidebar-item.active {
    background-color: #378d4c !important;
}

#sidebar .sidebar-item.active .sidebar-link {
    background-color: transparent !important;
}

/* Make active items have white text */
#sidebar .sidebar-item.active .sidebar-link i,
#sidebar .sidebar-item.active .sidebar-link span {
    color: white !important;
}

/* Add transition for smooth hover effect */
#sidebar .sidebar-item,
#sidebar .sidebar-link,
#sidebar .sidebar-link i,
#sidebar .sidebar-link span,
#sidebar .logout-btn,
#sidebar .logout-btn i,
#sidebar .logout-btn span {
    transition: all 0.3s ease;
}
</style>

@section('scripts')
<script>
    document.getElementById('logoutForm').addEventListener('submit', function(e) {
        e.preventDefault(); // cegah submit langsung

        const confirmed = confirm('Apakah Anda yakin ingin logout?');
        if (confirmed) {
            this.submit(); // jika ya, baru submit form
        }
    });
</script>
@endsection
