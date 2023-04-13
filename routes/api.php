<?php

use App\Http\Controllers\UniversityController;
use App\Http\Controllers\UniversityTypeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerifyEmailController;
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

// Route for user
Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::middleware('auth:api')->group(function () {
    Route::get('/logout', [UserController::class, 'logout']);
    Route::get('/user', [UserController::class, 'getDetail']);
});

// Verify email
Route::get('/email/verify/{id}/{hash}', [VerifyEmailController::class, '__invoke'])->middleware(['signed', 'throttle:6,1'])->name('verification.verify');

// Resend link to verify email
Route::post('/email/verify', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return Response([
        'status' => 200,
        'massage' => 'Verification link sent!'
    ], 200);
})->middleware(['auth:api', 'throttle:6,1'])->name('verification.send');

Route::resource('university_types', UniversityTypeController::class);
Route::resource('universities', UniversityController::class);
