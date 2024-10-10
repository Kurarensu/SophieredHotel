<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\User;

// Public routes
Route::post('/login', [App\Http\Controllers\Api\AuthController::class]);
Route::post('/register', [App\Http\Controllers\Api\AuthController::class]);

Route::post('/tokens/create', function (Request $request) {

    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);

    $user = User::where('email', $request->email)->first();

    // Create a personal access token for API access
    
    $token = $user->createToken('mobile_app')->plainTextToken;

    return response()->json([
        'access_token' => $token,
        'token_type' => 'Bearer',
    ]);
});

// Protected routes (require Sanctum tokens)
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('/logout', [App\Http\Controllers\Api\AuthController::class, 'logout']);
});