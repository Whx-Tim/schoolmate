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
//    Mail::raw('test email', function ($message) {
//        $message->from('whx@lewitech.cn', '微捐平台');
//        $message->to('598357301@qq.com')->subject('测试邮件');
//    });
    return 'successful!';
});

Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['middleware' => 'web', 'prefix' => 'api', 'namespace' => 'Index'], function () {
    Route::group(['middleware' => [], 'prefix' => 'active'], function () {
        Route::get('list', 'ActiveController@getActiveList');
        Route::get('detail/{active}', 'ActiveController@getActive');
        Route::get('getApplyActiveUsers/{active}', 'ActiveController@getApplyUsers');
        Route::post('storeActive', 'ActiveController@storeActive');
        Route::post('update/{active}', 'ActiveController@updateActive');
    });

    Route::group(['middleware' => [], 'prefix' => 'user'], function () {
        Route::get('info/{user}', 'UserController@getUserInfo');
        Route::get('auth/id', 'UserController@getAuthUserId');
        Route::get('auth/info', 'UserController@getAuthUserInfo');
        Route::get('courses', 'UserController@getUserCourses');
        Route::get('actives', 'UserController@getUserActives');
        Route::get('apply/actives', 'UserController@getUserApplyActives');
        Route::get('apply/courses', 'UserController@getUserAppplyCourses');
        Route::post('update', 'UserController@updateUserInfo');
    });

    Route::group(['middleware' => [], 'prefix' => 'course'], function () {
        Route::get('list', 'CourseController@getCourseList');
        Route::get('detail/{course}', 'CourseController@getCourseDetail');
        Route::get('applyCourseUsers/{course}', 'CourseController@getApplyUsers');
        Route::get('apply/{course}', 'CourseController@applyCourse')->where('course', '[0-9]+');
        Route::post('store', 'CourseController@storeCourse');
        Route::post('update/{course}', 'CourseController@updateCourse');
    });

    Route::group(['middleware' => [], 'prefix' => 'league'], function () {
        Route::get('list', 'LeagueController@getList');
        Route::get('detail/{league}', 'LeagueController@getLeague');
        Route::get('apply/{league}', 'LeagueController@applyLeague')->where('league', '[0-9]+');
        Route::post('store', 'LeagueController@storeLeague');
        Route::post('update/{league}', 'LeagueController@updateLeague');
    });

    Route::group(['middleware' => [], 'prefix' => 'info'], function () {
        Route::get('list', 'InfoController@getAllList');
        Route::get('partimeList', 'InfoController@getPartimeList');
        Route::get('announcementList', 'InfoController@getAnnouncementList');
    });
});
