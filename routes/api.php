<?php

use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\Auth\AuthTokenController;
use App\Http\Controllers\API\Auth\RegisterController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\API\HousesController;
use App\Http\Controllers\API\ListsController;
use App\Http\Controllers\API\NotificationController;
use App\Http\Controllers\API\SettingController;

use App\Http\Controllers\API\UserController;

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


Route::prefix('v1')->group(function () {
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('verify-otp', [AuthController::class, 'verifyOtp']);
    Route::post('register', [RegisterController::class, 'register'])->name('register');

    Route::middleware(['auth:sanctum'])->group(function () {
        Route::apiResource('houses', HousesController ::class);
        Route::put('update/start/house', [HousesController::class, 'updateHouseStart']);


        Route::put('update/setting/{id}', [HousesController::class, 'updateHouseSetting']);

        Route::apiResource('lists', ListsController ::class);
        Route::apiResource('notifications', NotificationController ::class);

        Route::put('lists/update/list/{id}', [ListsController::class, 'updateStatus']);
        Route::post('lists/get/upcoming', [ListsController::class, 'getUpcomingReminders']);
        Route::post('lists/event/date', [ListsController::class, 'getEventsByArrange']);
        Route::post('logout', [AuthController::class,'logout']);

        Route::prefix('user')->group(function () {
            Route::get('get/info', [UserController::class, 'user']);
            Route::put('update/user/info', [UserController::class, 'updateUserInfo']);
            Route::delete('delete/account', [UserController::class, 'deleteAccount']);

        });
        Route::put('update/setting',[UserController::class,'updateStatus']);

    });
});
Route::fallback(function () {
    return response()->json([
        'message' =>  __('messages.roue_not_found'),
        'code'=>404,
        'status'=>'false'
    ], 404);
});



