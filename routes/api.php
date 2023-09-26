<?php

use App\Http\Controllers\SpoolController;
use App\Http\Controllers\StoryController;
use App\Http\Controllers\UsersController;
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

Route::prefix('users')->group(function () {
    Route::get('', [UsersController::class, 'index']);
});

Route::prefix('stories')->group(function () {
    Route::get('', [StoryController::class, 'index']);
});

Route::get('/spool', [SpoolController::class, 'spoolHackerNews']);
