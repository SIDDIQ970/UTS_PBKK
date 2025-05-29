<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CoursesController;
use App\Http\Controllers\LecturersController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\CourseLecturersController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\ProductController;
use App\Http\Resources\UserResource;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('customer', CustomerController::class);
    Route::apiResource('order', OrderController::class);
    Route::apiResource('product', ProductController::class);
    Route::apiResource('orderitem', OrderItemController::class);
    Route::apiResource('category', CategoryController::class);
});
