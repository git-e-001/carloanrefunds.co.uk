<?php

namespace App\Providers;

use App\Http\Controllers\Helpers\CategoryHelper;
use App\Models\Brand;
use App\Models\Menu;
use App\Models\MenuItem;
use App\Models\Setting;
use App\Models\Social;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // social icon all data get here
//        View::composer(['includes.footer'], function ($view){
//            $globalSocialInfo = Social::status()->get();
//            $view->with('globalSocialInfo', $globalSocialInfo);
//        });

        // setting all data get here
        View::composer(['includes.footer', 'includes.header'], function ($view) {
            $globalSettingInfo = Setting::status()->first();
            $menu              = Menu::with(['menuItems' => function ($query) {
                $query->status()->orderBy('order', "ASC");
            }])->get();

            $menus_backend = $menu->where('site', 'backend')->first();
            $topmenus = $menu->where('site', 'frontend')->where('name', 'Frontend Header')->first();
            $footer_top_menus = $menu->where('site', 'frontend')->where('name', 'Frontend Footer First')->first();
            $footer_bottom_menus = $menu->where('site', 'frontend')->where('name', 'Frontend Footer Second')->first();

            $view->with([
                'globalSettingInfo'   => $globalSettingInfo,
                'topmenus'            => $topmenus,
                'footer_top_menus'    => $footer_top_menus,
                'footer_bottom_menus' => $footer_bottom_menus,
                'menus_backend'       => $menus_backend,
            ]);
        });

        View::composer(['admin.includes.sidebar', 'admin.auth.login', 'admin.auth.passwords.email', 'admin.auth.passwords.reset'], function ($view) {
            $globalSettingInfo = Setting::status()->first();
            $menu              = Menu::with('menuItems')->get();
            $menus_backend     = $menu->where('site', 'backend')->first();
            $view->with([
                'globalSettingInfo' => $globalSettingInfo,
                'menus_backend'     => $menus_backend,
            ]);
        });
    }
}
