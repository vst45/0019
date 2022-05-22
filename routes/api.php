<?php

use App\Http\Controllers\Api\OrderController;
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

Route::get('/order', [OrderController::class, 'order'])
->middleware('auth.api')
;

Route::get('/product', [OrderController::class, 'product'])
->middleware('auth.api')
;

Route::get('/list', [OrderController::class, 'list'])
->middleware('auth.api')
;

