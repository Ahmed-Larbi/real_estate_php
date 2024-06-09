<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\LikedController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Define resource routes for the controllers
Route::post('likeds', [LikedController::class, 'store']);
Route::post('accounts', [AccountController::class, 'store']);
Route::post('login', [AccountController::class, 'login']);
Route::get('search', [PostController::class, 'search']);
Route::post('likeds', [LikedController::class, 'store']);
Route::get('likeds', [LikedController::class, 'index']);
Route::apiResource('posts', PostController::class);
Route::apiResource('likeds', LikedController::class);




