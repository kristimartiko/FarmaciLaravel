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
//Route::middleware('auth')->post('/addProduct', [ProduktController::class, 'addProduct']);
//Route::middleware('auth')->delete('/delete/{id}', [ProduktController::class, 'destroy']);
//Route::middleware('auth')->put('/update/{id}', [ProduktController::class, 'update']);
//Route::middleware('auth')->put('/updateSasi/{id}', [ProduktController::class, 'addQuantity']);
Route::middleware(['isAdmin'])->group(function() {
    Route::post('/addProduct', [ProduktController::class, 'addProduct']);
    Route::delete('/delete/{id}', [ProduktController::class, 'destroy']);
    Route::put('/update/{id}', [ProduktController::class, 'update']);
    Route::put('/updateSasi/{id}', [ProduktController::class, 'addQuantity']);

    Route::get('/getUsers', [UserController::class, 'getUsers']);
    Route::put('/updateUsers/{id}', [UserController::class, 'updateUser']);
    Route::delete('/deleteUser/{id}', [UserController::class, 'deleteUser']);
});


//shporte api
Route::middleware('auth')->post('/addToCart/{id}', [ShporteController::class, 'shtoNeShporte']);
Route::middleware('auth')->get('/getShporte', [ShporteController::class, 'getShporte']);
Route::middleware('auth')->get('/shtoSasi/{id}', [ShporteController::class, 'shtoSasi']);
Route::middleware('auth')->get('/hiqSasi/{id}', [ShporteController::class, 'hiqSasi']);
Route::middleware('auth')->delete('/cartDelete/{id}', [ShporteController::class, 'fshij']);
Route::middleware('auth')->get('/purchase', [ShporteController::class, 'purchase']);
Route::middleware('auth')->get('/getPurchases', [ShporteController::class, 'getPurchases']);

//login and register api
Route::post('/register', [LoginController::class, 'register']);
Route::post('/login', [LoginController::class, 'login']);
Route::middleware('auth')->get('/isAdmin', [LoginController::class, 'isAdmin']);
Route::middleware('auth')->get('/getActualUser', [LoginController::class, 'getActualUser']);
Route::middleware('auth')->get('/logout', [LoginController::class, 'logout']);

//user api
//Route::middleware('auth')->get('/getUsers', [UserController::class, 'getUsers']);
//Route::middleware('auth')->put('/updateUser/{id}', [UserController::class, 'updateUser']);
//Route::middleware('auth')->delete('/deleteUser/{id}', [UserController::class. 'deleteUser']);