<?php

use App\Http\Controllers\api\CashController;
use App\Http\Controllers\api\LoginController;
use App\Http\Controllers\api\MaterialcategoryController;
use App\Http\Controllers\api\MaterialController;
use App\Http\Controllers\api\PromoController;
use App\Http\Controllers\api\TrBuyController;
use App\Http\Controllers\api\TrProductionController;
use App\Http\Controllers\api\TrSaleController;
use App\Http\Controllers\api\UserController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// login
Route::post('dologin', [LoginController::class, 'dologin']); 
Route::post('dologout', [LoginController::class, 'dologout']); 

// Cash
Route::get('cash', [CashController::class, 'index']); 
Route::get('cash/{id}', [CashController::class, 'show']); 
Route::post('cash', [CashController::class, 'store']); 
Route::put('cash/{id}', [CashController::class, 'update']); 
Route::delete('cash/{id}', [CashController::class, 'destroy']); 

// Materialcategory
Route::get('materialcategory', [MaterialcategoryController::class, 'index']); 
Route::get('materialcategory/{id}', [MaterialcategoryController::class, 'show']); 
Route::post('materialcategory', [MaterialcategoryController::class, 'store']); 
Route::put('materialcategory/{id}', [MaterialcategoryController::class, 'update']); 
Route::delete('materialcategory/{id}', [MaterialcategoryController::class, 'destroy']); 

// Material
Route::get('material', [MaterialController::class, 'index']); 
Route::get('material/{id}', [MaterialController::class, 'show']); 
Route::post('material', [MaterialController::class, 'store']); 
Route::put('material/{id}', [MaterialController::class, 'update']); 
Route::delete('material/{id}', [MaterialController::class, 'destroy']); 

// Promo
Route::get('promo', [PromoController::class, 'index']); 
Route::get('promo/{id}', [PromoController::class, 'show']); 
Route::post('promo', [PromoController::class, 'store']); 
Route::put('promo/{id}', [PromoController::class, 'update']); 
Route::delete('promo/{id}', [PromoController::class, 'destroy']);

// Trbuy
Route::get('trbuy', [TrBuyController::class, 'index']); 
Route::get('trbuy/{id}', [TrBuyController::class, 'show']); 
Route::post('trbuy', [TrBuyController::class, 'store']); 
Route::put('trbuy/{id}', [TrBuyController::class, 'update']); 
Route::delete('trbuy/{id}', [TrBuyController::class, 'destroy']);

// TrProduction
Route::get('trproduction', [TrProductionController::class, 'index']); 
Route::get('trproduction/{id}', [TrProductionController::class, 'show']); 
Route::post('trproduction', [TrProductionController::class, 'store']); 
Route::put('trproduction/{id}', [TrProductionController::class, 'update']); 
Route::delete('trproduction/{id}', [TrProductionController::class, 'destroy']);

// TrSale
Route::get('trsale', [TrSaleController::class, 'index']); 
Route::get('trsale/{id}', [TrSaleController::class, 'show']); 
Route::post('trsale', [TrSaleController::class, 'store']); 
Route::put('trsale/{id}', [TrSaleController::class, 'update']); 
Route::delete('trsale/{id}', [TrSaleController::class, 'destroy']);

// User
Route::get('user', [UserController::class, 'index']); 
Route::get('user/{id}', [UserController::class, 'show']); 
Route::post('user', [UserController::class, 'store']); 
Route::put('user/{id}', [UserController::class, 'update']); 
Route::delete('user/{id}', [UserController::class, 'destroy']);