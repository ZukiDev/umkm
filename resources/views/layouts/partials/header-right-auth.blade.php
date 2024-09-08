<!-- Profile and Logout Dropdown -->
<li class="nav-item submenu dropdown">
    <a href="#" class="nav-link dropdown-toggle d-flex align-items-center" data-toggle="dropdown" role="button"
        aria-haspopup="true" aria-expanded="false">
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <!-- Display User Profile Photo -->
            <img class="rounded-circle me-2" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}"
                style="width: 30px; height: 30px; object-fit: cover;">
        @else
            <!-- Display Default Icon if no Profile Photo -->
            <i class="fa fa-user-circle fa-2x me-2"></i>
        @endif
        {{-- <span class="d-none d-md-block">{{ Auth::user()->name }}</span> --}}
    </a>
    <ul class="dropdown-menu">
        <!-- Profile Link -->
        <li class="nav-item">
            <a class="nav-link" href="{{ route('profile.show') }}">
                {{ __('Profile') }}
            </a>
        </li>

        <!-- Logout Form -->
        <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}" class="d-inline">
                @csrf
                <a class="nav-link" href="{{ route('logout') }}"
                    onclick="event.preventDefault(); this.closest('form').submit();">
                    {{ __('Logout') }}
                </a>
            </form>
        </li>
    </ul>
</li>
