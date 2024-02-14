<?php

use App\Http\Controllers\CreateNotificationController;
use App\Http\Controllers\DeleteNotificationController;
use App\Http\Controllers\ShowNotificationController;
use App\Http\Controllers\UpdateNotificationController;
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

Route::get('/get_notification/{id}', [ShowNotificationController::class, 'getNotification'])
    ->whereNumber('id');

Route::post('/create_notification', [CreateNotificationController::class, 'createNotification']);

Route::patch('/edit_notification', [UpdateNotificationController::class, 'updateNotification']);

Route::delete('/remove_notification/{id}', [DeleteNotificationController::class, 'deleteNotification'])
    ->whereNumber('id');
