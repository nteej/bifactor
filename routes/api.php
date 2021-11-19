<?php

use Illuminate\Http\Request;
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
Route::prefix('v1')->group(function () {
    Route::resource('companies', \App\Http\Controllers\CompanyController::class)->except(['create', 'edit'])->parameters(
        ['companies' => 'company:uuid']
    );
    Route::resource('invoices', \App\Http\Controllers\InvoiceController::class)->except(['create', 'edit'])->parameters(
        ['invoices' => 'invoice:uuid']
    );
    Route::resource('fcOrders', \App\Http\Controllers\FcOrderController::class)->except(['create', 'edit'])->parameters(
        ['fcOrders' => 'fcOrder:uuid']
    );
    Route::resource('customers', \App\Http\Controllers\CustomerController::class)->except(['create', 'edit'])->parameters(
        ['customers' => 'customer:uuid']
    );

    Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });
});
