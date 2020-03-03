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

Route::middleware('jwt')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['jwt']], function () {
    Route::prefix('v1')->group(function () {
        // Route::resource('users', 'UserController');
        Route::resource('projects', 'ProjectController');
        Route::resource('reviews', 'ReviewController');
        Route::resource('skills', 'SkillController');
        Route::resource('specializations', 'SpecializationController');
    });
});

Route::post("login", "JwtLoginController@login");
