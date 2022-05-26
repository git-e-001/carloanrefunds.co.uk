<?php

namespace Database\Seeders;

use App\Models\Fontawesome;
use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Database\Seeder;

class MenuItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $backendMenu = Menu::where('slug', 'backend-left-menu')->first();
        if ($backendMenu) {
            $backendMenus = [
                [
                    'name'            => 'Dashboard',
                    'slug'            => slug('Dashboard'),
                    'module'          => '',
                    'icon'            => Fontawesome::where('className', 'fas fa-tachometer-alt')->first()->id ?? '',
                    'type'            => 'url',
                    'value'           => '/admin/dashboard',
                    'target'          => '_self',
                    'active_resolver' => '',
                    'status'          => true,
                    'order'           => 1,
                    'menu_id'         => $backendMenu->id,
                    'created_by'      => 1,
                    'updated_by'      => 1,
                ],
                [
                    'name'            => 'Menus',
                    'slug'            => slug('menus'),
                    'module'          => '',
                    'icon'            => Fontawesome::where('className', 'fa fa-bars')->first()->id ?? '',
                    'type'            => 'route',
                    'value'           => 'admin.menu-items.index',
                    'target'          => '_self',
                    'active_resolver' => '',
                    'status'          => true,
                    'order'           => 2,
                    'menu_id'         => $backendMenu->id,
                    'created_by'      => 1,
                    'updated_by'      => 1,
                ],
                [
                    'name'            => 'Sliders',
                    'slug'            => slug('sliders'),
                    'module'          => '',
                    'icon'            => Fontawesome::where('className', 'fas fa-photo-video')->first()->id ?? '',
                    'type'            => 'route',
                    'value'           => 'admin.sliders.index',
                    'target'          => '_self',
                    'active_resolver' => '',
                    'status'          => true,
                    'order'           => 2,
                    'menu_id'         => $backendMenu->id,
                    'created_by'      => 1,
                    'updated_by'      => 1,
                ],
                [
                    'name'            => 'Contents',
                    'slug'            => slug('contents'),
                    'module'          => '',
                    'icon'            => Fontawesome::where('className', 'far ion-ios-paper')->first()->id ?? '',
                    'type'            => 'route',
                    'value'           => 'admin.pages.index',
                    'target'          => '_self',
                    'active_resolver' => '',
                    'status'          => true,
                    'order'           => 3,
                    'menu_id'         => $backendMenu->id,
                    'created_by'      => 1,
                    'updated_by'      => 1,
                ],
                [
                    'name'            => 'Customers',
                    'slug'            => slug('customers'),
                    'module'          => '',
                    'icon'            => Fontawesome::where('className', 'fa fa-users')->first()->id ?? '',
                    'type'            => 'route',
                    'value'           => 'admin.customers.index',
                    'target'          => '_self',
                    'active_resolver' => '',
                    'status'          => true,
                    'order'           => 4,
                    'menu_id'         => $backendMenu->id,
                    'created_by'      => 1,
                    'updated_by'      => 1,
                ],
                [
                    'name'            => 'Lenders',
                    'slug'            => slug('lenders'),
                    'module'          => '',
                    'icon'            => Fontawesome::where('className', 'far fa-money-bill-alt')->first()->id ?? '',
                    'type'            => 'route',
                    'value'           => 'admin.lenders.index',
                    'target'          => '_self',
                    'active_resolver' => '',
                    'status'          => true,
                    'order'           => 5,
                    'menu_id'         => $backendMenu->id,
                    'created_by'      => 1,
                    'updated_by'      => 1,
                ],
                [
                    'name'            => 'Agreements',
                    'slug'            => slug('agreements'),
                    'module'          => '',
                    'icon'            => Fontawesome::where('className', 'fas fa-pencil-alt')->first()->id ?? '',
                    'type'            => 'route',
                    'value'           => 'admin.agreements.index',
                    'target'          => '_self',
                    'active_resolver' => '',
                    'status'          => true,
                    'order'           => 6,
                    'menu_id'         => $backendMenu->id,
                    'created_by'      => 1,
                    'updated_by'      => 1,
                ],
                [
                    'name'            => 'Settings',
                    'slug'            => slug('Settings'),
                    'module'          => '',
                    'icon'            => Fontawesome::where('className', 'fa fa-cog')->first()->id ?? '',
                    'type'            => 'route',
                    'value'           => 'admin.settings.index',
                    'target'          => '_self',
                    'active_resolver' => '',
                    'status'          => true,
                    'order'           => 7,
                    'menu_id'         => $backendMenu->id,
                    'created_by'      => 1,
                    'updated_by'      => 1,
                ],
                [
                    'name'            => 'Socials',
                    'slug'            => slug('Socials'),
                    'module'          => '',
                    'icon'            => Fontawesome::where('className', 'fas fa-photo-video')->first()->id ?? '',
                    'type'            => 'route',
                    'value'           => 'admin.socials.index',
                    'target'          => '_self',
                    'active_resolver' => '',
                    'status'          => true,
                    'order'           => 7,
                    'menu_id'         => $backendMenu->id,
                    'created_by'      => 1,
                    'updated_by'      => 1,
                ],
            ];

            foreach ($backendMenus as $backendMenu) {
                MenuItem::updateOrCreate($backendMenu);
            }
        }
    }
}
