<header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center">

        <a href="{{ route('landing-page.index') }}" class="logo d-flex align-items-center me-auto">
            <img src="{{ asset('logo-banten.png') }}" alt="">
            <!-- Uncomment the line below if you also wish to use an text logo -->
            <h1 class="sitename">Siperi</h1>
        </a>

        <nav id="navmenu" class="navmenu">
            <ul>
                @foreach (config('landing_menu') as $menu)
                    @include('components.front.partials.menu', ['menu' => $menu])
                @endforeach
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

        <button class="bg-success cta-btn d-none d-sm-block" href="#buy-tickets" data-bs-toggle="modal"
            data-bs-target="#exLargeModal">Daftar</button>

    </div>
</header>
