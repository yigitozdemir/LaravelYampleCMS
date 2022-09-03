<?php

use App\Http\Controllers\PropertyController;
use App\Http\Controllers\UserController;
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

// User registry api
Route::controller(UserController::class)->group(function () {
    Route::post('login', 'login')->name('login');
    Route::post('register', 'register');
    Route::post('refresh', 'refresh');
    Route::post('logout', 'logout');
    Route::post('profile', 'profile');
});



/**
 * Routes
 * Property Api
 */
Route::controller(PropertyController::class)->group(function () {
    Route::get('property/getAll', 'getPropertyDefinitions');
    Route::get('property/get/{id}', 'getPropertyDefinition');
    Route::delete('property/delete/{id}', 'deletePropertyDefinition');
    Route::post('property/create', 'createPropertyDefinition');
    Route::post('property/update/name/{id}', 'updatePropertyName');
    Route::post('property/update/description/{id}', 'updatePropertyDescription');
});