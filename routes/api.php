<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProduktController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ShporteController;
use App\Http\Controllers\UserController;


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

//product api
Route::get('/getAllProducts', [ProduktController::class, 'getAllProducts']);
Route::post('/addProduct', [ProduktController::class, 'addProduct']);
Route::delete('/delete/{id}', [ProduktController::class, 'destroy']);
Route::put('/update/{id}', [ProduktController::class, 'update']);

//shporte api
Route::post('/addToCart/{id}', [ShporteController::class, 'shtoNeShporte']);
Route::post('/shtoSasi/{id}', [ShporteController::class, 'shtoSasi']);
Route::post('/hiqSasi/{id}', [ShporteController::class, 'hiqSasi']);
Route::delete('/cartDelete/{id}', [ShporteController::class, 'fshij']);
Route::post('/purchase', [ShporteController::class, 'purchase']);

//login and register api
Route::post('/register', [LoginController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);
Route::get('/isAdmin', [LoginController::class, 'isAdmin']);
Route::get('/getActualUser', [LoginController::class, 'getActualUser']);
Route::post('/logout', [LoginController::class, 'logout']);

//user api
Route::get('/getUsers', [UserController::class, 'getUsers']);
Route::put('/updateUser/{id}', [UserController::class, 'updateUser']);
Route::delete('/deleteUser/{id}', [UserController::class. 'deleteUser']);