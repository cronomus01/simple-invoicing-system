<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\LoginController;
use App\Http\Middleware\Authenticate;
use App\Http\Middleware\IsAuth;
use App\Http\Middleware\RedirectIfAuthenticated;
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

Route::middleware([RedirectIfAuthenticated::class])->resource('/login', LoginController::class);
Route::middleware([IsAuth::class])->resource('/dashboard', DashboardController::class);
Route::middleware([IsAuth::class])->resource('/invoice', InvoiceController::class);

require __DIR__ . '/auth.php';
