<!-- Profile and Logout Dropdown -->
<li class="nav-item submenu dropdown" style="position: relative; display: flex; align-items: center;">
    <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" data-toggle="dropdown" role="button"
        aria-haspopup="true" aria-expanded="false" style="padding: 0;">
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <!-- Display User Profile Photo -->
            <img class="rounded-circle" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}"
                style="width: 30px; height: 30px; object-fit: cover; margin-right: 8px;">
        @else
            <!-- Display Default Icon if no Profile Photo -->
            <i class="fa fa-user-circle fa-2x me-2" style="font-size: 30px;"></i>
        @endif
        {{-- <span class="d-none d-md-block">{{ Auth::user()->name }}</span> --}}
    </a>
    <ul class="dropdown-menu"
        style="position: absolute; top: 100%; right: 0; margin: 0; padding: 0; border-radius: 0; border: 1px solid #ddd; background-color: #fff; z-index: 1000;">
        <!-- Profile Link -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('profile.show') }}">
                {{ __('Informasi Pribadi') }}
            </a>
        </li>

        <!-- Logout Form -->
        <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <a class="nav-link" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('Keluar') }}
                </a>
            </form>
        </li>
    </ul>
</li>
