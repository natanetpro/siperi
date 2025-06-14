<!-- resources/views/layouts/menu-children.blade.php -->
<ul class="menu-sub">
    @foreach ($children as $childItem)
        @if (Auth::user()->hasRole($childItem['permission']))
            <li class="menu-item">
                <a href="{{ url($childItem['url']) }}"
                    class="menu-link {{ isset($childItem['children']) && count($childItem['children']) > 0 ? 'menu-toggle' : '' }} fw-bold">
                    <div data-i18n="{{ $childItem['nama_menu'] }}">{{ $childItem['nama_menu'] }}</div>
                </a>

                @if (isset($childItem['children']) && count($childItem['children']) > 0)
                    @include('partials.menu', ['children' => $childItem['children']])
                @endif
            </li>
        @endif
    @endforeach
</ul>
