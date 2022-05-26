<?php

use App\Http\Controllers\OutsourceLeadController;
use App\Models\Customer;
use App\Services\BrightOfficeService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

//Route::get('/customer-xml/{customer}', function (Customer $customer) {
//    $dd = new BrightOfficeService();
//    $dd->submitToBrightOffice($customer, true);
//    dd('ok');
//});

Route::post('/leads', [OutsourceLeadController::class, 'apiStore']);
