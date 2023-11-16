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

// Route::get('families/list', [FamiliesControllerApi::class, 'index'])->name('apiFamiliesIndex');

Route::resource('trees',TreeControllerApi::class)->names('api.trees');
Route::post('login', [AuthControllerApi::class, 'login']);

Route::group(['middleware' => ['auth:sanctum', 'web']], function () {
    Route::post('logout', [AuthControllerApi::class, 'logout']);
});
