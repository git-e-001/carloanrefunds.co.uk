<!-- Main Sidebar Container -->
<aside class="main-sidebar elevation-4 themeBgColor custom_sidebar_bg">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" target="_blank" class="brand-link themeBgColor">
        <span class="brand-text text-white font-weight-light">{{ config('app.name') }}</span>
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar Menu -->
        <nav class="mt-2 ddMenuAppend">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                data-accordion="false">
                <!-- Add icons to the links using the .nav-icon class
                     with font-awesome or any other icon font library -->
                @foreach($menus_backend->menuItems()->status()->orderBy('order', "ASC")->get() as $menu)
                    @if($menu->name !== 'Socials')
                        <li class="nav-item" id="menuId-{{$menu->id}}">
                            @if($menu->type === 'custom-url')
                                <a href="{{ $menu->value }}" target="{{ $menu->target }}" class="nav-link"
                                   onclick="activeMenu('{{ $menu->id }}')">
                                    <i class="nav-icon {{ $menu->iconName->className}}"></i>
                                    <p>
                                        {{ $menu->name }}
                                    </p>
                                </a>
                            @elseif($menu->type === 'url')
                                <a target="{{ $menu->target }}" href="{{ url($menu->value) }}" class="nav-link"
                                   onclick="activeMenu('{{ $menu->id }}')">
                                    <i class="nav-icon {{ $menu->iconName->className}}"></i>
                                    <p>
                                        {{ $menu->name }}
                                    </p>
                                </a>
                            @elseif($menu->type === 'route')
                                <a target="{{ $menu->target }}" href="{{ route($menu->value) }}" class="nav-link"
                                   onclick="activeMenu('{{ $menu->id }}')">
                                    <i class="nav-icon {{ $menu->iconName->className}}"></i>
                                    <p>
                                        {{ $menu->name }}
                                    </p>
                                </a>
                            @elseif($menu->type === 'page')
                                <a target="{{ $menu->target }}" href="{{ url($menu->value) }}" class="nav-link"
                                   onclick="activeMenu('{{ $menu->id }}')">
                                    <i class="nav-icon {{ $menu->iconName->className}}"></i>
                                    <p>
                                        {{ $menu->name }}
                                    </p>
                                </a>
                            @endif
                        </li>
                    @endif
                @endforeach
            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>

<script>
    function activeMenu(id) {
        localStorage.setItem('menuId', id)
    }

    if (localStorage.getItem('menuId')) {
        document.getElementById(`menuId-${localStorage.getItem('menuId')}`).classList.add("activeMenu")
    }
</script>
