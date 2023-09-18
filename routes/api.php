<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\CollegeController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CompanySkillsetController;
use App\Http\Controllers\JobsController;
use App\Http\Controllers\SkillsetController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentRankController;
use App\Http\Controllers\StudentSkillsetController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');

    return "Cleared!";

});

Route::post('/signup', ['as' => '', 'uses' => 'Api\AuthController@createUser']);
Route::post('/signin', ['as' => '', 'uses' => 'Api\AuthController@loginUser']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::apiResource('company', CompanyController::class);
    Route::apiResource('student', StudentController::class);
    Route::apiResource('skillset', SkillsetController::class);
//    Route::apiResource('userLocation', 'UserLocationController');
    Route::apiResource('studentSkillset', StudentSkillsetController::class);
    Route::apiResource('studentRank', StudentRankController::class);
    Route::apiResource('companySkillset', CompanySkillsetController::class);
    Route::apiResource('user', UserController::class);
    Route::apiResource('college', CollegeController::class);

    Route::post('jobs', [JobsController::class, 'store']);
    Route::get('mfa-qrcode', [AuthController::class, 'mfaQrcode']);
    Route::put('jobs/{jobs}', [JobsController::class, 'update']);
    Route::delete('jobs/{jobs}', [JobsController::class, 'destroy']);

    Route::post('/email/verification-notification',
        [VerifyEmailController::class, 'resendNotification'])
        ->name('verification.send');

    Route::get('student/skillset/{student}', [StudentController::class, 'showSkillset']);
});

Route::get('jobs', [JobsController::class, 'index']);
Route::get('jobs/{jobs}', [JobsController::class, 'show']);
Route::get('jobs/user/{user}', [JobsController::class, 'showByUser']);
