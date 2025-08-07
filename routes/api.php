<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ApplyServiceController;
use App\Http\Controllers\SoloProviderController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\SoloRequesterController;
use App\Http\Controllers\CompanyproviderController;
use App\Http\Controllers\CompanyRequesterController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/verify-email', [AuthController::class, 'verifyEmail']);
Route::post('/forgot-password', [PasswordResetController::class, 'sendResetLink']);
Route::post('/reset-password', [PasswordResetController::class, 'reset']);
Route::middleware('auth:sanctum')->get('/profile', [ProfileController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    // Shared job access (all authenticated users)
    Route::get('/jobs', [JobController::class, 'index']);      // List all jobs
    Route::get('/jobs/{id}', [JobController::class, 'show']);  // View a job
});
Route::middleware(['auth:sanctum', 'roletype:provider,solo'])
    ->post('/solo-provider-action', [SoloProviderController::class, 'handle']);

Route::middleware(['auth:sanctum', 'roletype:provider,company'])
    ->post('/company-provider-action', [CompanyproviderController::class, 'handle']);


Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/jobs/{job}/apply', [ApplyServiceController::class, 'apply'])->name('jobs.apply');
});

Route::middleware(['auth:sanctum', 'roletype:seeker,solo'])
    ->post('/solo-seeker-action', [SoloRequesterController::class, 'handle']);

Route::middleware(['auth:sanctum', 'roletype:seeker,company'])
    ->post('/company-seeker-action', [CompanyRequesterController::class, 'handle']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/jobs', [JobController::class, 'store']);
});



