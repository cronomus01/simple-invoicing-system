<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PaymentController;
use Illuminate\Support\Facades\Route;

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

// Route::middleware(Authenticate::class)->get('/', function () {
//     return view('home');
// });

Route::get('/', function () {
    return redirect()->route('login.index');
});

Route::resource('/login', LoginController::class)->middleware('guest');
Route::resource('/dashboard', DashboardController::class)->middleware('auth');
Route::resource('/invoice', InvoiceController::class)->middleware('auth');
Route::resource('/payment', PaymentController::class)->middleware('auth');

require __DIR__ . '/auth.php';
