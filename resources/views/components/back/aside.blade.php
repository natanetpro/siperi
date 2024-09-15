<aside id="layout-menu" class="layout-menu-horizontal menu-horizontal menu bg-menu-theme flex-grow-0">
    <div class="container-xxl d-flex h-100">
        <!-- resources/views/layouts/menu.blade.php -->
        <ul class="menu-inner">
            @foreach (config('admin_menu') as $menuItem)
                <li class="menu-item">
                    <a href="javascript:void(0)"
                        class="menu-link {{ isset($menuItem['children']) && count($menuItem['children']) > 0 ? 'menu-toggle' : '' }} fw-bold">
                        <div data-i18n="{{ $menuItem['nama_menu'] }}">{{ $menuItem['nama_menu'] }}</div>
                    </a>

                    @if (isset($menuItem['children']) && count($menuItem['children']) > 0)
                        @include('components.back.partials.menu', ['children' => $menuItem['children']])
                    @endif
                </li>
            @endforeach
        </ul>
    </div>
</aside>
