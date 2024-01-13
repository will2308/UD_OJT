<?php

use App\Http\Controllers\MaterialcategoryController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PromoController;
use App\Http\Controllers\TrBuyController;
use App\Http\Controllers\TrProductionController;
use App\Http\Controllers\TrSaleController;
use App\Http\Controllers\UserController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [PageController::class, 'index'])->name('home'); 
Route::get('/login', [PageController::class, 'login'])->name('login'); 
Route::post('/register', [PageController::class, 'register'])->name('register'); 
Route::post('/dologin', [PageController::class, 'dologin'])->name('dologin'); 
Route::get('/admin', [PageController::class, 'dashboard'])->name('dashboard'); 
Route::get('/logout', [PageController::class, 'logout'])->name('logout'); 

// kategori bahan 
Route::get('kategori', [MaterialcategoryController::class, 'index'])->name('kategori'); 
Route::post('kategori', [MaterialcategoryController::class, 'store']);
Route::get('kategori/{id}', [MaterialcategoryController::class, 'edit']);
Route::delete('kategori/{id}', [MaterialcategoryController::class, 'destroy']);

// Material
Route::get('material', [MaterialController::class, 'index'])->name('material');  
Route::post('material', [MaterialController::class, 'store']);
Route::get('material/{id}', [MaterialController::class, 'edit']);
Route::delete('material/{id}', [MaterialController::class, 'destroy']);

// Promo
Route::get('promo', [PromoController::class, 'index'])->name('promo'); 
Route::post('promo', [PromoController::class, 'store']);
Route::get('promo/{id}', [PromoController::class, 'edit']);
Route::delete('promo/{id}', [PromoController::class, 'destroy']);

// Trbuy
Route::get('trbuy', [TrBuyController::class, 'index'])->name('trbuy'); 
Route::post('trbuy', [TrBuyController::class, 'store']);
// Route::get('trbuy/{id}', [TrBuyController::class, 'edit']);
Route::delete('trbuy/{id}', [TrBuyController::class, 'destroy']);

// User 
Route::get('user', [UserController::class, 'index'])->name('user'); 
Route::post('user', [UserController::class, 'store']);
Route::get('user/{id}', [UserController::class, 'edit']);
Route::delete('user/{id}', [UserController::class, 'destroy']);

// Trproduction
Route::get('trproduction', [TrProductionController::class, 'index'])->name('trproduction'); 
Route::post('trproduction', [TrProductionController::class, 'store']);
// Route::get('trproduction/{id}', [TrProductionController::class, 'edit']);
// Route::delete('trproduction/{id}', [TrProductionController::class, 'destroy']);

// Trsale 
Route::post('trsale', [TrSaleController::class, 'store']);
// Route::get('trproduction/{id}', [TrProductionController::class, 'edit']);
// Route::delete('trproduction/{id}', [TrProductionController::class, 'destroy']);
