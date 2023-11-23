<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\PaymentController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'store']);

Route::get('/home', [HomeController::class, 'index']);

Route::get('/invoices', [InvoiceController::class, 'index']);
Route::get('/invoices/create', [InvoiceController::class, 'create']);
Route::post('/invoices/store', [InvoiceController::class, 'store']);
Route::get('/invoices/edit/{id}', [InvoiceController::class, 'edit']);
Route::put('/invoices/update/{id}', [InvoiceController::class, 'update']);
Route::delete('/invoices/delete/{id}', [InvoiceController::class, 'destroy']);

Route::get('/payment/show/{id}', [PaymentController::class, 'show']);
Route::post('/payment/store/{id}', [PaymentController::class, 'store']);
