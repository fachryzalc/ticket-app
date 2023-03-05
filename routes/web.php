<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\TransactionController;
use App\Models\Transaction;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

Auth::routes();

Route::get('/', [HomeController::class, 'index']);


Route::get('/cart', [CartController::class, 'index'])->middleware('auth');
Route::get('/addtocart/{id}', [CartController::class, 'addToCart'])->middleware('auth');
Route::get('/updatecart/{id}', [CartController::class, 'updateCart'])->middleware('auth');
Route::get('/deletecart/{id}', [CartController::class, 'deleteCart'])->middleware('auth');
Route::get('/myorders', [TransactionController::class, 'myorders'])->middleware('auth');



Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('/order', OrderController::class);
    Route::resource('/ticket', TicketController::class);
    Route::resource('/transaction', TransactionController::class);
});

Route::controller(\App\Http\Controllers\UserController::class)->group(function () {
    Route::get('/login', 'login')->name('login')->middleware('guest');
    Route::post('/login', 'doLogin');
    Route::post('/logout', 'doLogout')->middleware('auth');
    Route::get('/register', 'register')->middleware('guest');
    Route::post('/register', 'doRegister');
});


// Route::controller(\App\Http\Controllers\AdminController::class)->middleware(['auth', 'admin'])->group(function () {
//     Route::get('/admin', 'index');
//     Route::get('/transaction', 'transaction');
// });

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
