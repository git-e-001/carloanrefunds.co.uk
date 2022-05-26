<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MenuItemRequest;
use App\Models\Fontawesome;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Page;
use Illuminate\Http\Request;
use Route;

class MenuItemController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->perPage ?: 10;
        $keyword = $request->keyword;

        //get all Lender
        $menus = Menu::with('menuItems')->latest();

        if ($keyword) {
            $keyword = '%' . $keyword . '%';
            $menus   = $menus->where('name', 'like', $keyword);
        }

        $menus = $menus->paginate($perPage);

        return view('admin.pages.menu.index', compact('menus'));
    }

    public function itemCreate($menu)
    {
        $menu = Menu::where('id', $menu)->first();
//        $sitePaths = [$allUrls, $allRoutes];
        $fontawesome = Fontawesome::all();
        $menuTypes   = ['route' => 'Route', 'url' => 'Url', 'custom-url' => 'Custom Url', 'page' => 'Page'];

        return view('admin.pages.menu.create', compact(
            'menu', 'fontawesome', 'menuTypes',
        ));
    }

    public function store(MenuItemRequest $request)
    {
        $existItem = MenuItem::where(['menu_id' => $request->menu_id, 'name' => $request->name])->first();
        if ($existItem) {
            $message = 'The ' . strtolower($request->name) . ' name already exit on ' . strtolower($existItem->menu->name);

            return redirect()->back()->with(['warning' => $message]);
        }

        $order = MenuItem::where('menu_id', $request->menu_id)->count();
        MenuItem::create([
            'name'       => $request->name,
            'icon'       => $request->icon,
            'type'       => $request->type,
            'value'      => $request->value1 ?? $request->custom_value,
            'target'     => $request->target,
            'menu_id'    => $request->menu_id,
            'order'      => ++$order,
            'text_color' => $request->input('text_color'),
            'bg_color'   => $request->input('bg_color'),
            'status'     => $request->status ? true : false,
        ]);

        return redirect()->back()->with('success', 'Menu Item Successfully Created');
    }

    public function edit(MenuItem $menuItem)
    {
        $fontawesome = Fontawesome::all();
        $menuTypes   = ['route' => 'Route', 'url' => 'Url', 'custom-url' => 'Custom Url', 'page' => 'Page'];
        $menu        = $menuItem->menu;
        if ($menuItem->type !== 'custom-url') {
            $types = $this->typeSelect($menuItem->type);
        } else {
            $types = $menuItem->type;
        }

        return view('admin.pages.menu.edit', compact(
            'menuItem', 'fontawesome', 'menuTypes', 'menu', 'types'));
    }

    public function update(MenuItemRequest $request, MenuItem $menuItem)
    {
//        $existItem = MenuItem::where('name', $request->name)
//            ->where('menu_id', '!=', $menuItem->menu_id)->first();
        $existItem = MenuItem::where(['menu_id' => $request->menu_id, 'name' => $request->name])->first();
        if ($existItem) {
            if ($menuItem->id !== $existItem->id) {
                $message = 'The ' . strtolower($request->name) . ' name already exit on ' . strtolower($existItem->menu->name);

                return redirect()->back()->with(['warning' => $message]);
            }
        }

        $menuItem->update([
            'name'    => $request->name,
            'icon'    => $request->icon,
            'type'    => $request->type,
            'value'   => $request->value1 ?? $request->custom_value,
            'target'  => $request->target,
            'menu_id' => $request->menu_id,
            'text_color' => $request->input('text_color'),
            'bg_color'   => $request->input('bg_color'),
            'status'  => $request->status ? true : false,
        ]);

        return redirect()->back()->with('success', 'Menu Item Successfully Updated');
    }

    public function menuEdit($menu)
    {
        $menu = Menu::where('id', $menu)->with('menuItems')->first();

        return view('admin.pages.menu.show-items', compact('menu'));
    }

    public function destroy(MenuItem $menuItem)
    {
        $menuItem->delete();

        return redirect()->back()->with('success', 'Menu-Item Deleted Successfully');
    }

    public function menuTypeChange(Request $request)
    {
        return $this->typeSelect($request->type);
    }

    public function menuOrder(Request $request, $id)
    {
        $orderItems = json_decode($request->get('order'));

        foreach ($orderItems as $index => $orderItem) {
            $this->ordering($orderItem->id, $index, $id);
        }
        $site = Menu::where('id', $id)->first()->site;

        return $site;
    }

    public function ordering($itemId, $index, $menu_id)
    {
        $item = MenuItem::where('menu_id', $menu_id)->where('id', $itemId)->first();
        $item->update([
            'order' => $index,
        ]);
    }

    public function typeSelect($type)
    {
        $data  = [];
        $liste = [];
        if ($type === 'route' || $type === 'url') {
            $routeCollection = Route::getRoutes();

            foreach ($routeCollection as $key => $value) {
                $url   = $value->uri();
                $route = $value->getName();
                if (!empty($url && $route) && $key > 4) {
                    if (strpos($url, '{') === false &&
                        strpos($url, '}') === false &&
                        strpos($route, 'generated') === false) {
                        if ($type === 'route') {
                            array_push($data, ['type' => $route, 'value' => $route]);
                        } else {
                            if ($liste !== null) {
                                if (!in_array($url, $liste)) {
                                    array_push($liste, $url);
                                    array_push($data, ['type' => $url, 'value' => $url]);
                                }
                            }
                        }
                    }
                }
            }

            return $data;
        } elseif ($type === 'page') {
            $pages = Page::all();
            foreach ($pages as $page) {
                array_push($data, ['type' => $page->title, 'value' => $page->slug]);
            }

            return $data;
        }
    }

    // when drag and drop menu change live change for backend sidebar menu change
    public function sidebarMenuChange()
    {
        $menus_backend = Menu::with('menuItems')->where('site', 'backend')->first();

        return view('admin.pages.menu.dragAndDropMenu', compact('menus_backend'));
    }

    public function headerFooterBgChange(Request $request): \Illuminate\Http\RedirectResponse
    {
        $request->validate([
            'menu_id'  => 'required|numeric',
            'bg_color' => 'required|string'
        ]);

        $menu           = Menu::findOrFail($request->input('menu_id'));
        $menu->bg_color = $request->input('bg_color');
        $menu->save();

        return redirect()->back()->with('success', 'Menu background color successfully changed');
    }
}
