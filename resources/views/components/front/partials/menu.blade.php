<li class="{{ !empty($menu['children']) ? 'dropdown' : '' }}">
    <a href="{{ $menu['url'] }}">
        <span>{{ $menu['nama_menu'] }}</span>
        @if (!empty($menu['children']))
            <i class="bi bi-chevron-down toggle-dropdown"></i>
        @endif
    </a>

    @if (!empty($menu['children']))
        <ul>
            @foreach ($menu['children'] as $childMenu)
                @include('components.front.partials.menu', ['menu' => $childMenu])
            @endforeach
        </ul>
    @endif
</li>
