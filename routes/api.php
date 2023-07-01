<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Auth\CommentController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\ProfileController;
use App\Http\Controllers\Auth\RateController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\MajorRecommendationController;
use App\Http\Controllers\MajorTypeController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\University\DepartmentController;
use App\Http\Controllers\University\FacultyController;
use App\Http\Controllers\University\MajorController;
use App\Http\Controllers\University\SubjectController;
use App\Http\Controllers\University\UniversityBranchController;
use App\Http\Controllers\University\UniversityController;
use App\Http\Controllers\University\UniversityImageController;
use App\Http\Controllers\University\UniversityTypeController;
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

Route::middleware('guest')->group(function () {
    // Email register and login
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    // Social login
    Route::get('auth/{provider}', [AuthController::class, 'redirectToProvider']);
    Route::get('auth/{provider}/callback', [AuthController::class, 'handleProviderCallback']);
    // Verify email
    Route::get('email/verify/{id}/{hash}', [VerificationController::class, 'verifyEmail'])
        ->middleware('signed')
        ->name('verification.verify');
    // Forgot password
    Route::post('password/forgot', [PasswordController::class, 'forgotPassword']);
    Route::post('password/reset', [PasswordController::class, 'resetPassword']);

    // Major
    Route::controller(MajorTypeController::class)->group(function () {
        Route::get('/major_types', 'index');
        Route::get('/major_types/{id}', 'show');
    });

    // City and Provinces
    Route::controller(ProvinceController::class)->group(function () {
        Route::get('/provinces', 'index');
    });

    Route::controller(UniversityTypeController::class)->group(function () {
        Route::get('/university_types', 'index');
    });

    // Universities
    Route::controller(UniversityController::class)->group(function () {
        Route::get('/universities', 'index');
        Route::get('/universities/{id}', 'show');
    });

    Route::controller(UniversityImageController::class)->group(function () {
        Route::get('/university_images', 'index');
        Route::get('/university_images/{id}', 'show');
    });

    Route::controller(UniversityBranchController::class)->group(function () {
        Route::get('/university_branches', 'index');
        Route::get('/university_branches/{id}', 'show');
    });

    Route::controller(FacultyController::class)->group(function () {
        Route::get('/faculties', 'index');
        Route::get('/faculties/{id}', 'show');
    });

    Route::controller(DepartmentController::class)->group(function () {
        Route::get('/departments', 'index');
        Route::get('/departments/{id}', 'show');
    });

    Route::controller(MajorController::class)->group(function () {
        Route::get('/majors', 'index');
        Route::get('/majors/{id}', 'show');
    });

    Route::controller(SubjectController::class)->group(function () {
        Route::get('/subjects', 'index');
        Route::get('/subjects/{id}', 'show');
    });

    Route::post('major_recommendation', [MajorRecommendationController::class, 'index']);
});

Route::middleware('auth:api')->group(function () {
    // User information
    Route::get('logout', [AuthController::class, 'logout']);
    Route::get('profile', [ProfileController::class, 'getProfile']);
    Route::put('profile', [ProfileController::class, 'updateProfile']);
    Route::post('password/change', [PasswordController::class, 'changePassword']);

    // Resend link to verify email
    Route::post('email/verify', [VerificationController::class, 'resendEmail'])
        ->middleware('throttle:6,1');

    // Comment
    Route::post('comment', [CommentController::class, 'store']);
    Route::get('comment/by_user', [CommentController::class, 'showByUser']);
    Route::get('comment/by_user/{universityId}', [CommentController::class, 'showByUserUniversity']);
    Route::get('comment/by_university/{universityId}', [CommentController::class, 'showByUniversity']);
    Route::put('comment/{id}', [CommentController::class, 'update']);
    Route::delete('comment/{id}', [CommentController::class, 'destroy']);

    // Rate
    Route::post('rate', [RateController::class, 'store']);
    Route::get('rate/by_user', [RateController::class, 'showByUser']);
    Route::get('rate/by_user/{universityId}', [RateController::class, 'showByUserUniversity']);
    Route::get('rate/by_university', [RateController::class, 'showByUniversity']);
    Route::delete('rate/{id}', [RateController::class, 'destroy']);

    // ------------------------ Admin Access ------------------------ //
    Route::middleware('admin')->group(function () {
        // Major Type
        Route::controller(MajorTypeController::class)->group(function () {
            Route::post('/major_types', 'store');
            Route::put('/major_types/{id}', 'update');
            Route::delete('/major_types/{id}', 'destroy');
        });

        // Universities
        Route::controller(UniversityController::class)->group(function () {
            Route::post('/universities', 'store');
            Route::put('/universities/{id}', 'update');
            Route::delete('/universities/{id}', 'destroy');
        });

        Route::controller(UniversityImageController::class)->group(function () {
            Route::post('/university_images', 'store');
            Route::put('/university_images/{id}', 'update');
            Route::delete('/university_images/{id}', 'destroy');
        });

        Route::controller(UniversityBranchController::class)->group(function () {
            Route::post('/university_branches', 'store');
            Route::put('/university_branches/id', 'update');
            Route::delete('/university_branches/id', 'destroy');
        });

        Route::controller(FacultyController::class)->group(function () {
            Route::post('/faculties', 'store');
            Route::put('/faculties/{id}', 'update');
            Route::delete('/faculties/{id}', 'destroy');
        });

        Route::controller(DepartmentController::class)->group(function () {
            Route::post('/departments', 'store');
            Route::put('/departments/{id}', 'update');
            Route::delete('/departments/{id}', 'destroy');
        });

        Route::controller(MajorController::class)->group(function () {
            Route::post('/majors', 'store');
            Route::put('/majors/{id}', 'update');
            Route::delete('/majors/{id}', 'destroy');
        });

        Route::controller(SubjectController::class)->group(function () {
            Route::post('/subjects', 'store');
            Route::put('/subjects/{id}', 'update');
            Route::delete('/subjects/{id}', 'destroy');
        });
    });
});
