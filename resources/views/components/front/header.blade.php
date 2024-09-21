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
                <li>
                    <button class="bg-success cta-btn d-sm-block" data-bs-toggle="modal"
                        data-bs-target="#exLargeModal">Daftar</button>
                </li>
                <li class="mt-3 mt-lg-0">
                    {{-- @dd(Auth::user()->getRoleNames()) --}}
                    @if (Auth::check() && Auth::user()->hasRole('Administrator'))
                        <a href="{{ route('admin.dashboard.index') }}"
                            class="cta-btn d-sm-block bg-danger">Dashboard</a>
                    @elseif (Auth::check() && Auth::user()->hasRole('Pemohon'))
                        <a href="{{ route('peserta.dashboard.index') }}"
                            class="cta-btn d-sm-block bg-danger">Dashboard</a>
                    @elseif (Auth::check() && Auth::user()->hasRole('Pembimbing'))
                        <a href="{{ route('pembimbing.dashboard.index') }}"
                            class="cta-btn d-sm-block bg-danger">Dashboard</a>
                    @elseif(Auth::check() && Auth::user()->hasRole('Pimpinan'))
                        <a href="{{ route('admin.dashboard.index') }}"
                            class="cta-btn d-sm-block bg-danger">Dashboard</a>
                    @elseif (Auth::check() && Auth::user()->hasRole('Operator'))
                        <a href="{{ route('admin.dashboard.index') }}"
                            class="cta-btn d-sm-block bg-danger">Dashboard</a>
                    @else
                        <button class="cta-btn d-sm-block bg-danger" onclick="redirectDashboard()">Masuk</button>
                    @endif
                </li>
            </ul>
            <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>
    </div>
</header>

@push('scripts')
    <script>
        function redirectDashboard() {
            window.location.href = "{{ route('login') }}";
        }
    </script>
@endpush
