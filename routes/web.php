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
        Route::get('detail/{active_view}', 'ActiveController@getActive');
        Route::get('apply/{active}', 'ActiveController@applyActive');
        Route::get('getApplyActiveUsers/{active}', 'ActiveController@getApplyUsers');
        Route::post('info/publish/{active}', 'ActiveController@publishAnnouncement');
        Route::post('storeActive', 'ActiveController@storeActive');
        Route::post('update/{active}', 'ActiveController@updateActive');
        Route::post('upload/poster', 'ActiveController@uploadPoster');
    });

    Route::group(['middleware' => ['auth'], 'prefix' => 'user'], function () {
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
        Route::post('upload/avatar', 'UserController@uploadAvatar');
    });

    Route::group(['middleware' => [], 'prefix' => 'user'], function () {
        Route::get('fire/{code}', 'UserController@fireUser');
        Route::get('sendActivationCode', 'UserController@sendActivationCode');
        Route::get('logout', 'UserController@logout');
        Route::post('login', 'UserController@login');
        Route::post('register', 'UserController@register');
    });

    Route::group(['middleware' => ['auth'], 'prefix' => 'course'], function () {
        Route::get('list', 'CourseController@getCourseList');
        Route::get('detail/{course_view}', 'CourseController@getCourseDetail');
        Route::get('applyCourseUsers/{course}', 'CourseController@getApplyUsers');
        Route::get('apply/{course}', 'CourseController@applyCourse')->where('course', '[0-9]+');
        Route::get('invite/{code}', 'CourseController@inviteCodeGetCourse');
        Route::get('file/list/{course}', 'CourseController@fileList');
        Route::post('store', 'CourseController@storeCourse');
        Route::post('update/{course}', 'CourseController@updateCourse');
        Route::post('info/publish/{course}', 'CourseController@publishAnnouncement');
        Route::post('upload/{course}', 'CourseController@fileUpload');
        Route::post('sign/{course}', 'CourseController@courseSign');
        Route::post('initiate/sign/{course}', 'CourseController@initiateSign');
    });

    Route::group(['middleware' => ['auth'], 'prefix' => 'league'], function () {
        Route::get('list', 'LeagueController@getList');
        Route::get('detail/{league_view}', 'LeagueController@getLeague');
        Route::get('apply/{league}', 'LeagueController@applyLeague')->where('league', '[0-9]+');
        Route::get('apply/users/{league}', 'LeagueController@applyLeagueUsers');
        Route::post('upload','LeagueController@uploadPoster');
        Route::post('store', 'LeagueController@storeLeague');
        Route::post('update/{league}', 'LeagueController@updateLeague');
        Route::post('info/publish/{league}', 'LeagueController@publishAnnouncement');
    });

    Route::group(['middleware' => ['auth'], 'prefix' => 'info'], function () {
        Route::get('list', 'InfoController@getAllList');
        Route::get('partimeList', 'InfoController@getPartimeList');
        Route::get('partime/detail/{partime_view}', 'InfoController@getPartimeDetail');
        Route::get('announcementList', 'InfoController@getAnnouncementList');
        Route::get('userActiveList', 'InfoController@getUserActiveAnnouncements');
        Route::get('list/active', 'InfoController@getUserActiveAnnouncements');
        Route::get('list/course', 'InfoController@getUserCourseAnnouncements');
        Route::get('list/league', 'InfoController@getUserLeagueAnnouncements');
        Route::get('announcement/detail/{announcement_view}', 'InfoController@getAnnouncement');
        Route::get('comment/list/{announcement}', 'InfoController@getCommentList');
        Route::post('partime/store', 'InfoController@storePartime');
        Route::post('comment/store/{announcement}', 'InfoController@storeComment');
    });

    Route::group(['middleware' => ['auth'], 'prefix' => 'good'], function () {
        Route::get('list', 'GoodController@getGoodList');
        Route::get('detail/{good}', 'GoodController@getGood');
        Route::get('delete/{good}', 'GoodController@delete');
        Route::get('down/{good}', 'GoodController@down');
        Route::get('up/{good}', 'GoodController@up');
        Route::get('my', 'GoodController@myGoods');
        Route::post('search', 'GoodController@searchGood');
        Route::post('store', 'GoodController@storeGood');
    });

    Route::group([
        'middleware' => ['web'],
        'prefix'     => 'message'
    ], function () {
        Route::get('list/{send_to}', 'MessageController@getList');
        Route::get('user/list', 'MessageController@userList');
        Route::get('out/{send_to}', 'MessageController@outChat');
        Route::post('store', 'MessageController@store');

    });
});

Route::group([
    'middleware' => ['web', 'admin', 'auth'],
    'prefix'     => 'admin',
    'namespace'  => 'Admin'
], function  () {
    Route::get('/', 'IndexController@show');
    Route::post('upload', 'IndexController@upload');
    Route::group([
        'prefix' => 'active'
    ], function () {
        Route::get('/', 'ActiveController@show');
        Route::get('detail/{active_view}', 'ActiveController@detail');
        Route::get('edit/{active}', 'ActiveController@edit');
        Route::get('delete/{active}', 'ActiveController@delete');
        Route::get('store', 'ActiveController@showStore');
        Route::post('store', 'ActiveController@store');
        Route::post('edit/{active}', 'ActiveController@update');
    });

    Route::group([
        'prefix' => 'course'
    ], function () {
        Route::get('/', 'CourseController@show');
        Route::get('store', 'CourseController@add');
        Route::get('edit/{course}', 'CourseController@edit');
        Route::get('detail/{course_view}', 'CourseController@detail');
        Route::get('delete/{course}', 'CourseController@delete');
        Route::post('store', 'CourseController@store');
        Route::post('edit/{course}', 'CourseController@update');
    });

    Route::group([
        'prefix' => 'league'
    ], function () {
        Route::get('/', 'LeagueController@show');
        Route::get('store', 'LeagueController@add');
        Route::get('edit/{league}', 'LeagueController@edit');
        Route::get('detail/{league_view}', 'LeagueController@detail');
        Route::get('delete/{league}', 'LeagueController@delete');
        Route::post('store', 'LeagueController@store');
        Route::post('edit/{league}', 'LeagueController@update');
    });

    Route::group([
        'prefix' => 'good'
    ], function () {
        Route::get('/', 'GoodController@show');
        Route::get('store', 'GoodController@add');
        Route::get('edit/{good}', 'GoodController@edit');
        Route::get('detail/{good_view}', 'GoodController@detail');
        Route::get('delete/{good}', 'GoodController@delete');
        Route::post('store', 'GoodController@store');
        Route::post('edit/{good}', 'GoodController@update');
    });

    Route::group([
        'prefix' => 'user'
    ], function () {
        Route::get('/', 'UserController@show');
        Route::get('edit/{user}', 'UserController@edit');
        Route::get('detail/{user}', 'UserController@detail');
        Route::get('delete/{user}', 'UserController@delete');
        Route::post('edit/{user}', 'UserController@update');
    });

    Route::group([
        'prefix' => 'announcement'
    ], function () {
        Route::get('/', 'AnnouncementController@show');
        Route::get('store', 'AnnouncementController@add');
        Route::get('edit/{announcement}', 'AnnouncementController@edit');
        Route::get('detail/{announcement_view}', 'AnnouncementController@detail');
        Route::get('delete/{announcement}', 'AnnouncementController@delete');
        Route::post('edit/{announcement}', 'AnnouncementController@update');
        Route::post('store', 'AnnouncementController@store');
    });

    Route::group([
        'prefix' => 'statistics'
    ], function () {
        Route::get('/', 'StatisticsController@index');
    });

    Route::group([
        'prefix' => 'data'
    ], function () {
        Route::get('/', 'DataController@index');
        Route::post('user', 'DataController@userFactory');
        Route::post('league', 'DataController@leagueFactory');
        Route::post('active', 'DataController@activeFactory');
        Route::post('course', 'DataController@courseFactory');
        Route::post('announcement', 'DataController@announcementFactory');
        Route::post('good', 'DataController@goodFactory');
        Route::post('comment', 'DataController@commentFactory');
        Route::post('info', 'DataController@infoFactory');
    });

    Route::group([
        'prefix' => 'info'
    ], function () {
        Route::get('/', 'InfoController@index');
        Route::get('store', 'InfoController@add');
        Route::get('edit/{partime}', 'InfoController@edit');
        Route::get('detail/{partime_view}', 'InfoController@detail');
        Route::get('delete/{partime}', 'InfoController@delete');
        Route::post('edit/{partime}', 'InfoController@update');
        Route::post('store', 'InfoController@store');
    });

    Route::group([
        'prefix' => 'setting'
    ], function () {
        Route::get('/', 'SettingController@index');
        Route::post('/reset', 'SettingController@resetPassword');

    });
});

Route::get('admin/login', 'Admin\IndexController@showLogin')->name('login');
Route::post('admin/login', 'Admin\IndexController@login');
Route::get('admin/logout', 'Admin\SettingController@logout');


Route::any('api/wechat/server', 'WechatController@server');

Route::any('api/test','Index\ActiveController@callbackTest');
