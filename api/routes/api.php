<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('/make-token', function () {
    $user = User::first();
    $token = $user->createToken('dev-token')->plainTextToken;
    return ['token' => $token];
})->name('login');
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
