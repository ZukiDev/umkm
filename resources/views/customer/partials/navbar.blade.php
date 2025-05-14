<!-- Start Navbar -->
<nav id="topnav" class="defaultscroll is-sticky bg-white dark:bg-slate-900">
    <div class="container relative">
        <!-- Logo container-->
        <a class="logo" href="{{ route('home') }}">
            <img src="{{ asset('asset/images/logo-dark.png') }}" class="inline-block dark:hidden" alt="">
            <img src="{{ asset('asset/images/logo-light.png') }}" class="hidden dark:inline-block" alt="">
        </a>

        <!--Login button Start-->
        <ul class="buy-button list-none mb-0">
            {{-- <li class="dropdown inline-block relative me-1">
                <button data-dropdown-toggle="dropdown" class="dropdown-toggle text-[20px]" type="button">
                    <i class="uil uil-search align-middle"></i>
                </button>
                <!-- Dropdown menu -->
                <div class="dropdown-menu absolute overflow-hidden end-0 m-0 mt-4 z-10 w-52 rounded-md bg-white dark:bg-slate-900 shadow dark:shadow-gray-800 hidden"
                    onclick="event.stopPropagation();">
                    <div class="relative">
                        <i class="uil uil-search text-lg absolute top-[3px] end-3"></i>
                        <input type="text" class="form-input h-9 pe-10 sm:w-44 w-36 border-0 focus:ring-0"
                            name="s" id="searchItem" placeholder="Search...">
                    </div>
                </div>
            </li> --}}

            @auth
                <li class="inline-block">
                    <a href="{{ route('customer.cart.index') }}"
                        class="py-2 px-5 inline-block font-semibold tracking-wide border align-middle duration-500 text-base text-center bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white rounded-md me-2">
                        <i class="mdi mdi-cart"></i> Keranjang
                    </a>
                </li>

                {{-- <li class="inline-block">
                    <a href="{{ route('login') }}"
                        class="py-2 px-5 inline-block font-semibold tracking-wide border align-middle duration-500 text-base text-center bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white rounded-md me-2">
                        <i class="uil uil-clipboard-notes"></i> Pesanan
                    </a>
                </li> --}}

                <li class="dropdown inline-block relative">
                    <button data-dropdown-toggle="dropdown"
                        class="dropdown-toggle size-9 inline-flex items-center justify-center tracking-wide align-middle duration-500 text-base text-center rounded-full bg-indigo-600 hover:bg-indigo-700 border border-indigo-600 hover:border-indigo-700 text-white"
                        type="button">
                        <img class="rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                            alt="{{ Auth::user()->name }}" />
                    </button>
                    <!-- Dropdown menu -->
                    <div class="dropdown-menu absolute end-0 m-0 mt-4 z-10 w-64 rounded-md bg-white dark:bg-slate-900 shadow dark:shadow-gray-800 hidden"
                        onclick="event.stopPropagation();">
                        <ul class="py-2 text-start" aria-labelledby="dropdownDefault">
                            <li>
                                <p class="block py-1.5 px-4 text-indigo-600"><i class="uil uil-user align-middle me-1"></i>
                                    {{ Auth::user()->name }}</p>
                            </li>
                            <li>
                                <a href="{{ route('customer.order.index') }}"
                                    class="block py-1.5 px-4 hover:text-indigo-600"><i
                                        class="uil uil-clipboard-notes align-middle me-1"></i> Pemesanan</a>
                                <a href="{{ route('customer.profile') }}" class="block py-1.5 px-4 hover:text-indigo-600"><i
                                        class="uil uil-setting align-middle me-1"></i> Profil</a>
                            </li>
                            <li class="border-t border-gray-100 dark:border-gray-800 my-2"></li>
                            <li>
                                <!-- Authentication Logout Form -->
                                <form method="POST" action="{{ route('logout') }}" x-data>
                                    @csrf
                                    <button type="submit" href="{{ route('logout') }}"
                                        class="block py-1.5 px-4 hover:text-indigo-600" @click.prevent="$root.submit();">
                                        <i class="uil uil-sign-out-alt align-middle me-1"></i> Keluar
                                    </button>
                                </form>
                            </li>
                        </ul>
                    </div>
                </li>
            @endauth
            @guest
                <li class="inline-block">
                    <a href="{{ route('login') }}"
                        class="py-2 px-5 inline-block font-semibold tracking-wide border align-middle duration-500 text-base text-center bg-indigo-600 hover:bg-indigo-700 border-indigo-600 hover:border-indigo-700 text-white rounded-md">
                        <i class="mdi mdi-account"></i> Masuk
                    </a>
                </li>
            @endguest
        </ul>
        <!--Login button End-->
    </div><!--end container-->
</nav><!--end header-->
<!-- End Navbar -->
