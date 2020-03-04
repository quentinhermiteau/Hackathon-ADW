<?php

use Illuminate\Http\Request;

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

Route::prefix('v1')->group(function () {
    Route::post("login", "JwtLoginController@login");

    Route::group(['middleware' => ['jwt']], function () {
        Route::resources([
            // 'users' => 'UserController',
            'projects' => 'ProjectController',
            'reviews' => 'ReviewController',
            'skills' => 'SkillController',
            'specializations' => 'SpecializationController'
        ]);
    });
});

