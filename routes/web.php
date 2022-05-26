<?php

use App\Http\Controllers\ApplyController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\LoansController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\SubmitController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('apply', [ApplyController::class, 'getIndex']);
Route::get('apply/start', [ApplyController::class, 'getStart']);

Route::group(['middleware' => ['app.docs']], function () {
    Route::get('apply/docs/{document}', [ApplyController::class, 'getDocumentHtml'])->where('document', 'contract|loa');
});

Route::get('resume/{resumeToken}', [ResumeController::class, 'getResume']);

Route::group(['middleware' => ['app.flow']], function () {
    Route::get('apply/customer-info', [ApplyController::class, 'getCustomerInfo'])->name('apply.customer.info');
    Route::post('apply/customer-info', [ApplyController::class, 'postCustomerInfo'])->name('apply.customer.info.store');

    Route::get('apply/esign', [ApplyController::class, 'getEsign'])->name('apply.customer.esign');
    Route::post('apply/esign', [ApplyController::class, 'postEsign'])->name('apply.customer.esign.store');

    Route::get('apply/next-step', [ApplyController::class, 'getNextSteps'])->name('apply.customer.next-step');

    Route::get('loans/no-info', [LoansController::class, 'getNoInfoLoan'])->name('apply.customer.no-info.loans');
    Route::post('loans/no-info', [LoansController::class, 'postNoInfoLoan'])->name('apply.customer.lender.store');

    Route::get('submit/no-info-success', [SubmitController::class, 'getNoInfoSubmitSuccess']);
    Route::get('submit/error', [SubmitController::class, 'getSubmitError']);

    Route::get('apply/esign-validation', [ApplyController::class, 'getEsignValidation']);
    Route::post('apply/esign-validation', [ApplyController::class, 'validateEsignCustomer']);

    Route::post('apply/validate-esign', [ApplyController::class, 'validateEsign']);
    Route::get('apply/esign-complete', [ApplyController::class, 'getEsignComplete']);

    Route::get('loans', [LoansController::class, 'getLoan']);
    Route::post('loans', [LoansController::class, 'postLoan']);

    Route::get('submit/success', [SubmitController::class, 'getSubmitSuccess']);
});

Route::get('sitemap.xml', [FileController::class, 'getSiteMap']);
Route::get('file/{location?}', [FileController::class, 'getFile'])->where('location', '(.*)');
// For Admin
require __DIR__ . '/admin.php';

Route::get('artisan/optimize', [\App\Http\Controllers\PhpArtisanCommandController::class, 'command']);

Route::post('tiny-file-upload', [\App\Http\Controllers\TinyFileUploadController::class, 'fileUpload']);
Route::post('tiny-file-upload-delete', [\App\Http\Controllers\TinyFileUploadController::class, 'deleteFile']);
Route::get('pages/content-remove/{id}', [\App\Http\Controllers\Admin\PageController::class, 'deletePageContent'])->middleware('auth:admin');

// this controller must be need to keep last line on this file
Route::get('{page:slug}', PageController::class);
