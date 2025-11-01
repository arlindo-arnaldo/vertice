<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClapController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/make-token', function () {
    $user = User::first();
    $token = $user->createToken('dev-token')->plainTextToken;

    return ['token' => $token];
});

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('v1')->group(function () {
    Route::controller(CategoryController::class)->prefix('categories')->group(function () {
        Route::get('/', 'index');
        Route::post('create', 'store');
        Route::get('show/{id}', 'show');
        Route::patch('update/{id}', 'update');
        Route::delete('delete/{id}', 'destroy');
    });

    Route::controller(PostController::class)->prefix('posts')->group(function () {
        Route::get('/', 'index');
        Route::post('/create', 'store');
        Route::get('show/{id}', 'show');
        Route::patch('update/{id}', 'update');
        Route::delete('delete/{id}', 'destroy');
    });
    Route::controller(CommentController::class)->prefix('comments')->group(function () {
        Route::get('/', 'index');
        Route::post('/create', 'store');
        Route::get('show/{id}', 'show');
        Route::patch('update/{id}', 'update');
        Route::delete('delete/{id}', 'destroy');
    });

    Route::post('/posts/add-clap/{id}', [ClapController::class, 'store']);
});
