@if (Route::has('login'))
    <li class="nav-item {{ Route::is('login') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('login') }}">{{ __('Masuk') }}</a>
    </li>
@endif
@if (Route::has('register'))
    <li class="nav-item {{ Route::is('register') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('register') }}">{{ __('Daftar') }}</a>
    </li>
@endif
