<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\SuscriptionController;

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

Route::post('/login', [AuthenticationController::class, 'login'])
    ->name('login');

Route::middleware('auth:sanctum')
    ->post('/logout', [AuthenticationController::class, 'logout'])
    ->name('logout');

Route::middleware('auth:sanctum')
    ->put('/suscribe', [SuscriptionController::class, 'suscribe'])
    ->name('suscribe'); 

Route::middleware('auth:sanctum')
    ->put('/unsuscribe', [SuscriptionController::class, 'unsuscribe'])
    ->name('unsuscribe');