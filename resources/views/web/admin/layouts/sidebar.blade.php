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
                <li class="sidebar-title">Menu</li>

                <li class="sidebar-item ">
                    <a href="index.html" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li class="sidebar-item has-sub {{ Request::is('admin/pemberkasan*') ? 'active' : '' }}">
                    <a href="#" class='sidebar-link'>
                        <i class="bi bi-stack"></i>
                        <span>Pemberkasan</span>
                    </a>
                    <ul class="submenu ">
                        <li class="submenu-item ">
                            <a href="{{ route('admin.pemberkasan.index') }}">List</a>
                        </li>
                        <li class="submenu-item ">
                            <a href="{{ route('admin.pemberkasan.create') }}">Create</a>
                        </li>
                    </ul>
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

                <li class="sidebar-title ">Data Siswa</li>

                <li class="sidebar-item {{ Request::is('admin/orangtua*') ? 'active' : '' }} ">
                    <a href="{{ route('admin.orangtua.index') }}" class='sidebar-link'>
                        <i class="bi bi-grid-fill"></i>
                        <span>Orang Tua & Siswa</span>
                    </a>
                </li>


                <li class="sidebar-item {{ Request::is('admin/seleksi*') ? 'active' : '' }}">
                    <a href="{{ route('admin.seleksi.index') }}" class='sidebar-link'>
                        <i class="bi bi-collection-fill"></i>
                        <span>Seleksi</span>
                    </a>

                </li>






            </ul>
        </div>
        <button class="sidebar-toggler btn x"><i data-feather="x"></i></button>
    </div>
</div>
