<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return 'successful!';
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['middleware' => 'web', 'prefix' => 'api', 'namespace' => 'Index'], function () {
    Route::group(['middleware' => [], 'prefix' => 'active'], function () {
        Route::get('list', 'ActiveController@getActiveList');
        Route::get('getActive/{id?}', 'ActiveController@getActive');
        Route::get('getApplyActiveUsers/{active}', 'ActiveController@getApplyUsers');
        Route::post('storeActive', 'ActiveController@storeActive');
        Route::post('update/{active}', 'ActiveController@updateActive');
    });

    Route::group(['middleware' => [], 'prefix' => 'user'], function () {
        Route::get('getUserInfo/{user}', 'UserController@getUserInfo');
        Route::get('getAuthUserId', 'UserController@getAuthUserId');
        Route::post('updateUserInfo', 'UserController@updateUserInfo');
    });

    Route::group(['middleware' => [], 'prefix' => 'course'], function () {
        Route::get('list', 'CourseController@getCourseList');
        Route::get('detail/{course}', 'CourseController@getCourseDetail');
        Route::get('applyCourseUsers/{course}', 'CourseController@getApplyUsers');
        Route::post('storeCourse', 'CourseController@storeCourse');
        Route::post('update/{course}', 'CourseController@updateCourse');
    });

    Route::group(['middleware' => [], 'prefix' => 'league'], function () {
        Route::get('list', 'LeagueController@getList');
    });
});
