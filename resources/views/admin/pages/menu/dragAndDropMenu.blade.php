<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
    data-accordion="false">
    <!-- Add icons to the links using the .nav-icon class
         with font-awesome or any other icon font library -->
    @foreach($menus_backend->menuItems()->status()->orderBy('order', "ASC")->get() as $menu)
        <li class="nav-item" id="menuId-{{$menu->id}}">
            @if($menu->type === 'custom-url')
                <a href="{{ $menu->value }}" class="nav-link" onclick="activeMenu('{{ $menu->id }}')">
                    <i class="nav-icon {{ $menu->iconName->className}}"></i>
                    <p>
                        {{ $menu->name }}
                    </p>
                </a>
            @elseif($menu->type === 'url')
                <a href="{{ url($menu->value) }}" class="nav-link" onclick="activeMenu('{{ $menu->id }}')">
                    <i class="nav-icon {{ $menu->iconName->className}}"></i>
                    <p>
                        {{ $menu->name }}
                    </p>
                </a>
            @elseif($menu->type === 'route')
                <a href="{{ route($menu->value) }}" class="nav-link"
                   onclick="activeMenu('{{ $menu->id }}')">
                    <i class="nav-icon {{ $menu->iconName->className}}"></i>
                    <p>
                        {{ $menu->name }}
                    </p>
                </a>
            @elseif($menu->type === 'page')
                <a href="{{ url($menu->value) }}" class="nav-link" onclick="activeMenu('{{ $menu->id }}')">
                    <i class="nav-icon {{ $menu->iconName->className}}"></i>
                    <p>
                        {{ $menu->name }}
                    </p>
                </a>
            @endif
        </li>
    @endforeach
</ul>
