<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\ImageController;
use App\Http\Controllers\MajorController;
use App\Http\Controllers\MajorTypeController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\RateController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\UniversityBranchController;
use App\Http\Controllers\UniversityController;
use App\Http\Controllers\UniversityTypeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerifyEmailController;
use App\Http\Controllers\YearController;
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

// Route for user and authentication
// Email register and login
Route::post('register', [UserController::class, 'register']);
Route::post('login', [UserController::class, 'login']);
// Social login
Route::get('auth/{provider}', [UserController::class, 'redirectToProvider']);
Route::get('auth/{provider}/callback', [UserController::class, 'handleProviderCallback']);
// Get user information
Route::middleware('auth:api')->group(function () {
    Route::get('logout', [UserController::class, 'logout']);
    Route::get('user', [UserController::class, 'getUser']);
    Route::put('user', [UserController::class, 'editUser']);
    Route::post('change_password', [UserController::class, 'changePassword']);
    Route::resource('comment', CommentController::class);
    Route::resource('rate', RateController::class);
});

// Forgot password
Route::post('forgot_password', [UserController::class, 'forgotPassword']);
Route::post('reset_password', [UserController::class, 'resetPassword']);
// Verify email
Route::get('email/verify/{id}/{hash}', [VerifyEmailController::class, '__invoke'])->middleware(['signed', 'throttle:6,1'])->name('verification.verify');

// Resend link to verify email
Route::post('email/verify', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return Response([
        'status' => 200,
        'massage' => 'Verification link sent!'
    ], 200);
})->middleware(['auth:api', 'throttle:6,1'])->name('verification.send');

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
