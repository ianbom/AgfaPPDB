<div id="sidebar" class="active">
    <div class="sidebar-wrapper active">
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



                {{-- <li class="sidebar-item  has-sub">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-collection-fill"></i>
                        <span>Extra Components</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="extra-component-avatar.html">Avatar</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="extra-component-sweetalert.html">Sweet Alert</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="extra-component-toastify.html">Toastify</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="extra-component-rating.html">Rating</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="extra-component-divider.html">Divider</a>
                        </li>
                    </ul>
                </li> --}}

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
