<?php

use Illuminate\Http\Request;
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

Route::get('/clear', function() {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');

    return "Cleared!";

 });

Route::post('/signup', ['as' => '', 'uses' => 'Api\AuthController@createUser']);
Route::post('/signin', ['as' => '', 'uses' => 'Api\AuthController@loginUser']);

Route::group(['middleware' => 'auth:sanctum'], function () {
    Route::apiResource('company', 'CompanyController');
    Route::apiResource('student', 'StudentController');
    Route::apiResource('skillset', 'SkillsetController');
    Route::apiResource('userLocation', 'UserLocationController');
    Route::apiResource('studentSkillset', 'StudentSkillsetController');
    Route::apiResource('studentRank', 'StudentRankController');
    Route::apiResource('companySkillset', 'CompanySkillsetController');
    Route::apiResource('user', 'UserController');
    Route::apiResource('college', 'CollegeController');

    Route::post('jobs', 'JobsController@store');
    Route::get('mfa-qrcode', [\App\Http\Controllers\Api\AuthController::class, 'mfaQrcode']);
    Route::put('jobs/{jobs}', 'JobsController@update');
    Route::delete('jobs/{jobs}', 'JobsController@destroy');

    Route::post('/email/verification-notification',
        [VerifyEmailController::class, 'resendNotification'])
        ->name('verification.send');

    Route::get('student/skillset/{student}', 'StudentController@showSkillset');
});

Route::get('jobs', 'JobsController@index');
Route::get('jobs/{jobs}', 'JobsController@show');
Route::get('jobs/user/{user}', 'JobsController@showByUser');
