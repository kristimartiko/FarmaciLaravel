<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProduktController;
use App\Http\Controllers\LoginController;


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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/getAllProducts', [ProduktController::class, 'getAllProducts']);
Route::post('/addProduct', [ProduktController::class, 'addProduct']);
Route::post('/addQuantity', [ProduktController::class, 'addQuantity']);

Route::post('/register', [LoginController::class, 'register']);