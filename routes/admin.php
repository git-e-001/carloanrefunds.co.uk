<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AgreementController;
use App\Http\Controllers\Admin\ApplyButtonChangeController;
use App\Http\Controllers\Admin\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\ResetPasswordController;

use App\Http\Controllers\Admin\BasicController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\LenderController;
use App\Http\Controllers\Admin\LoanController;
use App\Http\Controllers\Admin\MenuItemController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\SeoController;
use App\Http\Controllers\Admin\SettingController;

use App\Http\Controllers\Admin\SlidersController;
use App\Http\Controllers\Admin\SocialController;

use Illuminate\Support\Facades\Route;

Route::get('/admin', function () {
    return redirect()->route('admin.login');
});

/******************************* Start => auth sections *********************************/
Route::group(['as' => 'admin.', 'prefix' => 'admin'], function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [LoginController::class, 'login']);
    Route::post('logout', [LoginController::class, 'logout'])->name('logout');

    Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])
        ->name('password.request');

    Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])
        ->name('password.email');

    Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])
        ->name('password.reset');

    Route::post('password/reset', [ResetPasswordController::class, 'reset'])
        ->name('password.update');
});
/******************************* End => auth sections *********************************/

Route::group(['middleware' => ['auth:admin'], 'as' => 'admin.', 'prefix' => 'admin'], function () {
    // dashboard v_2
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    /******************************* Start => Slider sections *********************************/
    Route::resource('sliders', SlidersController::class)->except('show');
    Route::get('sliders/change-status/{slider}', [SlidersController::class, 'changeStatus'])
        ->name('sliders.status.change');
    /******************************* End => Slider sections *********************************/

    /******************************* Start => Social sections *********************************/
    Route::resource('socials', SocialController::class);
    Route::get('socials/change-status/{social}', [SocialController::class, 'changeStatus'])
        ->name('socials.status.change');
    /******************************* End => Social sections *********************************/

    /******************************* Start => setting sections *********************************/
    Route::resource('settings', SettingController::class);
    /******************************* End => setting sections *********************************/

    /******************************* Start => Admin Profile sections *********************************/
    Route::get('/profile', [AdminController::class, 'index'])->name('profile');
    Route::PATCH('/profile/{admin}/update', [AdminController::class, 'update'])->name('profile.update');
    Route::PATCH('/password/change', [AdminController::class, 'changePassword'])->name('password.change');
    /******************************* End => Admin Profile sections *********************************/

    /******************************* Start => Contact sections *********************************/
//    Route::resource('contacts', ContactController::class)->only(['index', 'edit', 'update']);
    /******************************* End => Contact sections *********************************/

    /******************************* Start => Contact sections *********************************/
    Route::resource('pages', PageController::class);
    Route::get('pages/change-status/{page}', [PageController::class, 'changeStatus'])
        ->name('pages.status.change');

    /******************************* End => Contact sections *********************************/

    /******************************* Start => lenders sections *********************************/
    Route::resource('lenders', LenderController::class);
    /******************************* End => lenders sections *********************************/

    /******************************* Start => agreements sections *********************************/
    Route::resource('agreements', AgreementController::class);
    /******************************* End => agreements sections *********************************/

    /******************************* Start => agreements sections *********************************/
    Route::resource('customers', CustomerController::class);
    /******************************* End => agreements sections *********************************/

    /******************************* Start => menu item sections *********************************/
    Route::resource('menu-items', MenuItemController::class);
    Route::get('menu-item/{menu}/create', [MenuItemController::class, 'itemCreate'])
        ->name('create.item');

    Route::get('menu-type', [MenuItemController::class, 'menuTypeChange'])
        ->name('menu-type.change');
    Route::get('menu/{menu}/edit', [MenuItemController::class, 'menuEdit'])
        ->name('menu.edit');
    Route::post('menu-order/{menu}', [MenuItemController::class, 'menuOrder'])
        ->name('menu-order');
    Route::get('menu-change', [MenuItemController::class, 'sidebarMenuChange'])
        ->name('sidebarMenu.change');

    Route::post('header-footer-bg-change', [MenuItemController::class, 'headerFooterBgChange'])
        ->name('change.header.footer.color');
    /******************************* End => menu item sections *********************************/

    /******************************* Start => seo sections *********************************/
    Route::resource('seos', SeoController::class);
    Route::get('pages-seo-content/{page_id}', [SeoController::class, 'getPageSeoContent'])->name('pages.seo.content');
    /******************************* End => seo sections *********************************/

    //    all site image delete
    Route::get('image/delete', [BasicController::class, 'imageDelete'])->name('image.delete');

    Route::get('apply/button/change', [ApplyButtonChangeController::class, 'index'])->name('apply.button');
    Route::post('apply/button/change', [ApplyButtonChangeController::class, 'change'])->name('apply.button.store');
});
