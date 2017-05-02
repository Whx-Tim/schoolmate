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
    return view('welcome');
});

//Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['middleware' => ['web'], 'prefix' => 'api', 'namespace' => 'Index'], function () {
    Route::group(['middleware' => ['auth'], 'prefix' => 'active'], function () {
        Route::get('list', 'ActiveController@getActiveList');
        Route::get('detail/{active}', 'ActiveController@getActive');
        Route::get('apply/{active}', 'ActiveController@applyActive');
        Route::get('getApplyActiveUsers/{active}', 'ActiveController@getApplyUsers');
        Route::post('info/publish/{active}', 'ActiveController@publishAnnouncement');
        Route::post('storeActive', 'ActiveController@storeActive');
        Route::post('update/{active}', 'ActiveController@updateActive');
        Route::post('upload/poster', 'ActiveController@uploadPoster');
    });

    Route::group(['middleware' => [], 'prefix' => 'user'], function () {
        Route::get('info/{user}', 'UserController@getUserInfo');
        Route::get('auth/id', 'UserController@getAuthUserId');
        Route::get('auth/info', 'UserController@getAuthUserInfo');
        Route::get('courses', 'UserController@getUserCourses');
        Route::get('actives', 'UserController@getUserActives');
        Route::get('leagues', 'UserController@getUserLeagues');
        Route::get('goods', 'UserController@getUserGoods');
        Route::get('apply/actives', 'UserController@getUserApplyActives');
        Route::get('apply/courses', 'UserController@getUserApplyCourses');
        Route::get('apply/leagues', 'UserController@getUserApplyLeagues');
        Route::post('update', 'UserController@updateUserInfo');

        Route::group(['middleware' => []], function () {
            Route::get('fire/{code}', 'UserController@fireUser');
            Route::get('sendActivationCode', 'UserController@sendActivationCode');
            Route::get('logout', 'UserController@logout');
            Route::post('login', 'UserController@login');
            Route::post('register', 'UserController@register');
        });
    });

    Route::group(['middleware' => ['auth'], 'prefix' => 'course'], function () {
        Route::get('list', 'CourseController@getCourseList');
        Route::get('detail/{course}', 'CourseController@getCourseDetail');
        Route::get('applyCourseUsers/{course}', 'CourseController@getApplyUsers');
        Route::get('apply/{course}', 'CourseController@applyCourse')->where('course', '[0-9]+');
        Route::get('invite/{code}', 'CourseController@inviteCodeGetCourse');
        Route::post('store', 'CourseController@storeCourse');
        Route::post('update/{course}', 'CourseController@updateCourse');
        Route::post('info/publish/{course}', 'CourseController@publishAnnouncement');
        Route::post('upload', 'CourseController@fileUpload');
        Route::post('sign/{course}', 'CourseController@courseSign');
        Route::post('initiate/sign/{course}', 'CourseController@initiateSign');
    });

    Route::group(['middleware' => ['auth'], 'prefix' => 'league'], function () {
        Route::get('list', 'LeagueController@getList');
        Route::get('detail/{league}', 'LeagueController@getLeague');
        Route::get('apply/{league}', 'LeagueController@applyLeague')->where('league', '[0-9]+');
        Route::post('upload','LeagueController@uploadPoster');
        Route::post('store', 'LeagueController@storeLeague');
        Route::post('update/{league}', 'LeagueController@updateLeague');
        Route::post('info/publish/{league}', 'LeagueController@publishAnnouncement');
    });

    Route::group(['middleware' => ['auth'], 'prefix' => 'info'], function () {
        Route::get('list', 'InfoController@getAllList');
        Route::get('partimeList', 'InfoController@getPartimeList');
        Route::get('partime/detail/{partime}', 'InfoController@getPartimeDetail');
        Route::get('announcementList', 'InfoController@getAnnouncementList');
        Route::get('userActiveList', 'InfoController@getUserActiveAnnouncements');
        Route::get('list/active', 'InfoController@getUserActiveAnnouncements');
        Route::get('list/course', 'InfoController@getUserCourseAnnouncements');
        Route::get('list/league', 'InfoController@getUserLeagueAnnouncements');
    });

    Route::group(['middleware' => ['auth'], 'prefix' => 'good'], function () {
        Route::get('list', 'GoodController@getGoodList');
        Route::get('detail/{good}', 'GoodController@getGood');
        Route::post('store', 'GoodController@storeGood');

    });

    Route::group([
        'middleware' => ['web'],
        'prefix'     => 'message'
    ], function () {
        Route::get('message/list/{send_to}', 'MessageController@getList');
        Route::post('message/store', 'MessageController@store');
    });
});

Route::group([
    'middleware' => ['web', 'auth'],
    'prefix'     => 'admin',
    'namespace'  => 'Admin'
], function  () {
    Route::get('/', 'IndexController@show');
    Route::group([
        'prefix' => 'active'
    ], function () {
        Route::get('/', 'ActiveController@show');
    });

    Route::group([
        'prefix' => 'course'
    ], function () {

    });

    Route::group([
        'prefix' => 'league'
    ], function () {

    });

    Route::group([
        'prefix' => 'good'
    ], function () {

    });

    Route::group([
        'prefix' => 'user'
    ], function () {

    });

    Route::group([
        'prefix' => 'announcement'
    ], function () {

    });

    Route::group([
        'prefix' => 'statistics'
    ], function () {

    });
});
