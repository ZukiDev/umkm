@if (Route::has('login'))
    <li class="nav-item {{ Route::is('login') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
    </li>
@endif
@if (Route::has('register'))
    <li class="nav-item {{ Route::is('register') ? 'active' : '' }}">
        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
    </li>
@endif
