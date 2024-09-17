<aside id="layout-menu" class="layout-menu-horizontal menu-horizontal menu bg-menu-theme flex-grow-0">
    <div class="container-xxl d-flex h-100">
        <!-- resources/views/layouts/menu.blade.php -->
        <ul class="menu-inner">
            @if (Auth::user()->hasRole('Pembimbing'))
                @foreach (config('pembimbing_menu') as $menuItem)
                    <li class="menu-item">
                        <a style="cursor: pointer;"
                            {{ isset($menuItem['children']) && count($menuItem['children']) > 0 ? '#"' : 'href=' . url($menuItem['url']) }}
                            class="menu-link {{ isset($menuItem['children']) && count($menuItem['children']) > 0 ? 'menu-toggle' : '' }} fw-bold">
                            <div data-i18n="{{ $menuItem['nama_menu'] }}">{{ $menuItem['nama_menu'] }}</div>
                        </a>

                        @if (isset($menuItem['children']) && count($menuItem['children']) > 0)
                            @include('components.back.partials.menu', [
                                'children' => $menuItem['children'],
                            ])
                        @endif
                    </li>
                @endforeach
            @elseif(Auth::user()->hasRole('Administrator'))
                @foreach (config('admin_menu') as $menuItem)
                    <li class="menu-item">
                        <a style="cursor: pointer;"
                            {{ isset($menuItem['children']) && count($menuItem['children']) > 0 ? '#"' : 'href=' . url($menuItem['url']) }}
                            class="menu-link {{ isset($menuItem['children']) && count($menuItem['children']) > 0 ? 'menu-toggle' : '' }} fw-bold">
                            <div data-i18n="{{ $menuItem['nama_menu'] }}">{{ $menuItem['nama_menu'] }}</div>
                        </a>

                        @if (isset($menuItem['children']) && count($menuItem['children']) > 0)
                            @include('components.back.partials.menu', [
                                'children' => $menuItem['children'],
                            ])
                        @endif
                    </li>
                @endforeach
            @elseif(Auth::user()->hasRole('Pemohon'))
                @foreach (config('peserta_menu') as $menuItem)
                    <li class="menu-item">
                        <a style="cursor: pointer;"
                            {{ isset($menuItem['children']) && count($menuItem['children']) > 0 ? '#"' : 'href=' . url($menuItem['url']) }}
                            class="menu-link {{ isset($menuItem['children']) && count($menuItem['children']) > 0 ? 'menu-toggle' : '' }} fw-bold">
                            <div data-i18n="{{ $menuItem['nama_menu'] }}">{{ $menuItem['nama_menu'] }}</div>
                        </a>

                        @if (isset($menuItem['children']) && count($menuItem['children']) > 0)
                            @include('components.back.partials.menu', [
                                'children' => $menuItem['children'],
                            ])
                        @endif
                    </li>
                @endforeach
            @endif
        </ul>
    </div>
</aside>
