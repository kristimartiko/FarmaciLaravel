<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProduktController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ShporteController;


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
Route::delete('/delete/{id}', [ProduktController::class, 'destroy']);
Route::put('/update/{id}', [Produkt::class, 'update']);

Route::post('/addToCart/{id}', [ShporteController::class, 'shtoNeShporte']);

Route::post('/register', [LoginController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);
