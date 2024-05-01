<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\UserController;
use App\Models\designation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::controller(AuthController::class)->group(function(){
    Route::post('login','login');
    Route::post('register','register');
});

Route::get('/get-session-data', [AuthController::class, 'getSessionData']);

Route::get('/users', [UserController::class, 'index']);
Route::get('/users/{id}', [UserController::class, 'find']);

Route::get('/designation', [DesignationController::class, 'index']);





