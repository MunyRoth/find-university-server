<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\CommentController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\RateController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\MajorTypeController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\University\DepartmentController;
use App\Http\Controllers\University\FacultyController;
use App\Http\Controllers\University\MajorController;
use App\Http\Controllers\University\SubjectController;
use App\Http\Controllers\University\UniversityBranchController;
use App\Http\Controllers\University\UniversityController;
use App\Http\Controllers\University\UniversityTypeController;
use App\Http\Controllers\YearController;
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

// Route for user and authentication
// Email register and login
Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
// Social login
Route::get('auth/{provider}', [AuthController::class, 'redirectToProvider']);
Route::get('auth/{provider}/callback', [AuthController::class, 'handleProviderCallback']);
// Get user information
Route::middleware('auth:api')->group(function () {
    Route::get('logout', [AuthController::class, 'logout']);
    Route::get('profile', [ProfileController::class, 'getProfile']);
    Route::put('profile', [ProfileController::class, 'updateProfile']);
    Route::post('change_password', [PasswordController::class, 'changePassword']);

    // Resend link to verify email
    Route::post('email/verify', [VerificationController::class, 'resendEmail'])->middleware('throttle:6,1');

    Route::resource('comment', CommentController::class);
    Route::resource('rate', RateController::class);
});

Route::middleware('guest')->group(function () {
    // Forgot password
    Route::post('forgot_password', [PasswordController::class, 'forgotPassword']);
    Route::post('reset_password', [PasswordController::class, 'resetPassword']);
});

// Verify email
Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verifyEmail'])->middleware(['signed', 'throttle:6,1']);

Route::post('image/{name}', [ImageController::class, 'store']);
Route::get('image/{name}', [ImageController::class, 'show']);

Route::resource('provinces', ProvinceController::class);
Route::resource('major_types', MajorTypeController::class);

Route::resource('university_types', UniversityTypeController::class);
Route::resource('universities', UniversityController::class);
Route::resource('university_branches', UniversityBranchController::class);
Route::resource('faculties', FacultyController::class);
Route::resource('departments', DepartmentController::class);
Route::resource('majors', MajorController::class);
Route::resource('years', YearController::class);
Route::resource('semesters', SemesterController::class);
Route::resource('subjects', SubjectController::class);
