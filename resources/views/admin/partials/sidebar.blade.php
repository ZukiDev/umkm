<!-- sidebar-wrapper -->
<nav id="sidebar" class="sidebar-wrapper sidebar-dark">
    <div class="sidebar-content">
        <div class="sidebar-brand">
            <a href="index.html"><img src="{{ asset('assets/images/logo-light.png') }}" height="24" alt=""></a>
        </div>

        <ul class="sidebar-menu border-t border-white/10" data-simplebar style="height: calc(100% - 70px);">
            <li class="{{ request()->routeIs('admin.dashboard.index') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard.index') }}"><i class="uil uil-chart-line me-2"></i>Dashboard</a>
            </li>
            <li class="{{ request()->routeIs('admin.product.index') ? 'active' : '' }}">
                <a href="{{ route('admin.product.index') }}"><i class="uil uil-shop me-2"></i>Produk</a>
            </li>
            <li class="{{ request()->routeIs('admin.order.index') ? 'active' : '' }}">
                <a href="{{ route('admin.order.index') }}"><i class="uil uil-shopping-cart me-2"></i>Konfirmasi
                    Pesanan</a>
            </li>
            <li class="{{ request()->routeIs('admin.order.index') ? 'active' : '' }}">
                <a href="{{ route('admin.order.index') }}"><i class="uil uil-invoice me-2"></i>Riwayat Pesanan</a>
            </li>
        </ul>
        <!-- sidebar-menu  -->
    </div>
</nav>
