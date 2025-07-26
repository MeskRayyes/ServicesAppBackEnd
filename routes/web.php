<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ApplyServiceController;
use App\Http\Controllers\SoloProviderController;
use App\Http\Controllers\PasswordResetController;

use App\Http\Controllers\SoloRequesterController;
use App\Http\Controllers\CompanyproviderController;
use App\Http\Controllers\CompanyrequesterrController;



Route::get('/reset-password/{token}', function (string $token) {
    return 'Reset password page for token: ' . $token;
})->name('password.reset');


Route::get('/', function () {
    return response()->json(['message' => 'Welcome to the API']);
});


// Route::post('/register', [AuthController::class, 'register']);
// Route::post('/verify-email', [AuthController::class, 'verifyEmail']);
// Route::post('/login', [AuthController::class, 'login']);
// Route::middleware('auth:sanctum')->post('/logout', [AuthController::class, 'logout']);


///////////////////////////////////////////
