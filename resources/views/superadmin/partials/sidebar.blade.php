<!-- sidebar-wrapper -->
<nav id="sidebar" class="sidebar-wrapper sidebar-dark">
    <div class="sidebar-content">
        <div class="sidebar-brand">
            <a href="index.html"><img src="{{ asset('assets/images/logo-light.png') }}" height="24" alt=""></a>
        </div>

        <ul class="sidebar-menu border-t border-white/10" data-simplebar style="height: calc(100% - 70px);">
            <li class="{{ request()->routeIs('superadmin.index') ? 'active' : '' }}">
                <a href="{{ route('superadmin.index') }}"><i class="uil uil-chart-line me-2"></i>Dashboard</a>
            </li>

            <li class="sidebar-dropdown {{ request()->routeIs('superadmin.data-master.*') ? 'active' : '' }}">
                <a href="javascript:void(0)"><i class="uil uil-browser me-2"></i>Data Master</a>
                <div class="sidebar-submenu">
                    <ul>
                        <li class="{{ request()->routeIs('superadmin.data-master.umkm.index') ? 'active' : '' }}">
                            <a href="{{ route('superadmin.data-master.umkm.index') }}">Data UMKM</a>
                        </li>
                        <li class="{{ request()->routeIs('superadmin.data-master.customer.index') ? 'active' : '' }}">
                            <a href="{{ route('superadmin.data-master.customer.index') }}">Data Customer</a>
                        </li>
                        <li class="{{ request()->routeIs('superadmin.data-master.category.index') ? 'active' : '' }}">
                            <a href="{{ route('superadmin.data-master.category.index') }}">Data Kategori</a>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
        <!-- sidebar-menu  -->
    </div>
</nav>
