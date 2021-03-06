<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('error',function (){
     return jsonErrorResponse(false, 401, [
        'logout' => 'You are unauthorized'
    ]);
})->name('error');

Route::post('login',[LoginController::class, 'login']);
Route::post('register',[LoginController::class, 'register']);
Route::post('logout',[LoginController::class, 'logout'])->middleware('auth:sanctum');
