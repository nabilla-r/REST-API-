<?php

use App\Http\Controllers\DrinkController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use Illuminate\Routing\RouteGroup;

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

Route::middleware('auth:sanctum')->group(function (){
    Route::get('/logout' , [AuthenticationController::class, 'logout']);
    //route untk mendapatkan data user yang sedang login
    Route::get('/me', [AuthenticationController::class, 'me']);
    //ini untk create data
    Route::post('/drinks', [DrinkController::class, 'store']);
    //untuk update data 
    Route::patch('/drinks/{id}', [DrinkController::class, 'update'])->middleware('shop-owner');
    //untuk delete
    Route::delete('/drinks/{id}', [DrinkController::class, 'destroy'])->middleware('shop-owner');
});

Route::get('/drinks', [DrinkController::class, 'index']);
Route::get('/drinks/{id}', [DrinkController::class, 'show']);
Route::post('/login', [AuthenticationController::class, 'login']);

