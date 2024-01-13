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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// login
Route::post('dologin', [LoginController::class, 'dologin']); 
Route::post('register', [LoginController::class, 'register']); 
Route::post('dologout', [LoginController::class, 'dologout']); 

// Cash
Route::get('cash', [CashController::class, 'index'])->middleware('auth:sanctum'); 
Route::get('cash/{id}', [CashController::class, 'show'])->middleware('auth:sanctum'); 
Route::post('cash', [CashController::class, 'store'])->middleware('auth:sanctum'); 
Route::put('cash/{id}', [CashController::class, 'update'])->middleware('auth:sanctum'); 
Route::delete('cash/{id}', [CashController::class, 'destroy'])->middleware('auth:sanctum'); 

// Materialcategory
Route::get('materialcategory', [MaterialcategoryController::class, 'index'])->middleware('auth:sanctum'); 
Route::get('materialcategory/{id}', [MaterialcategoryController::class, 'show'])->middleware('auth:sanctum');  
Route::post('materialcategory', [MaterialcategoryController::class, 'store'])->middleware('auth:sanctum');  
Route::put('materialcategory/{id}', [MaterialcategoryController::class, 'update'])->middleware('auth:sanctum');  
Route::delete('materialcategory/{id}', [MaterialcategoryController::class, 'destroy'])->middleware('auth:sanctum'); 

// Material
Route::get('material', [MaterialController::class, 'index'])->middleware('auth:sanctum'); 
Route::get('material/{id}', [MaterialController::class, 'show'])->middleware('auth:sanctum'); 
Route::post('material', [MaterialController::class, 'store'])->middleware('auth:sanctum');  
Route::put('material/{id}', [MaterialController::class, 'update'])->middleware('auth:sanctum');  
Route::delete('material/{id}', [MaterialController::class, 'destroy'])->middleware('auth:sanctum'); 

// Promo
Route::get('promo', [PromoController::class, 'index']); 
Route::get('promo/{id}', [PromoController::class, 'show'])->middleware('auth:sanctum');  
Route::post('promo', [PromoController::class, 'store'])->middleware('auth:sanctum'); 
Route::put('promo/{id}', [PromoController::class, 'update'])->middleware('auth:sanctum');  
Route::delete('promo/{id}', [PromoController::class, 'destroy'])->middleware('auth:sanctum'); 

// Trbuy
Route::get('trbuy', [TrBuyController::class, 'index'])->middleware('auth:sanctum'); 
Route::get('trbuy/{id}', [TrBuyController::class, 'show'])->middleware('auth:sanctum');  
Route::post('trbuy', [TrBuyController::class, 'store'])->middleware('auth:sanctum');  
Route::put('trbuy/{id}', [TrBuyController::class, 'update'])->middleware('auth:sanctum');  
Route::delete('trbuy/{id}', [TrBuyController::class, 'destroy'])->middleware('auth:sanctum'); 

// TrProduction
Route::get('trproduction', [TrProductionController::class, 'index']);
Route::get('trproduction/{id}', [TrProductionController::class, 'show'])->middleware('auth:sanctum'); 
Route::post('trproduction', [TrProductionController::class, 'store'])->middleware('auth:sanctum');  
Route::put('trproduction/{id}', [TrProductionController::class, 'update'])->middleware('auth:sanctum');  
Route::delete('trproduction/{id}', [TrProductionController::class, 'destroy'])->middleware('auth:sanctum'); 
// TrSale
Route::get('trsale', [TrSaleController::class, 'index'])->middleware('auth:sanctum'); 
Route::get('trsale/{id}', [TrSaleController::class, 'show'])->middleware('auth:sanctum'); 
Route::post('trsale', [TrSaleController::class, 'store'])->middleware('auth:sanctum');  
Route::put('trsale/{id}', [TrSaleController::class, 'update'])->middleware('auth:sanctum');  
Route::delete('trsale/{id}', [TrSaleController::class, 'destroy'])->middleware('auth:sanctum'); 

// User
Route::get('user', [UserController::class, 'index'])->middleware('auth:sanctum');  
Route::get('user/{id}', [UserController::class, 'show'])->middleware('auth:sanctum'); 
Route::post('user', [UserController::class, 'store'])->middleware('auth:sanctum'); 
Route::put('user/{id}', [UserController::class, 'update'])->middleware('auth:sanctum'); 
Route::delete('user/{id}', [UserController::class, 'destroy'])->middleware('auth:sanctum'); 