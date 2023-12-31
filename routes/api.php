<?php

use App\Http\Controllers\api\AuthControllerApi;
use App\Http\Controllers\api\TreeControllerApi;
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
Route::post('/login', [AuthControllerApi::class, 'login']);
Route::middleware('auth:sanctum')->post('/logout', [AuthControllerApi::class, 'logout']);
Route::middleware('auth:sanctum')->resource('trees',TreeControllerApi::class)->names('api.trees');