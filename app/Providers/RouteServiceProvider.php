<?php

namespace App\Providers;

use App\Events\ViewPage;
use App\Model\Active;
use App\Model\Announcement;
use App\Model\Course;
use App\Model\Good;
use App\Model\League;
use App\Model\Partime;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * @var int 路由自定义解析缓存时间
     */
    protected $cache_time = 10;

    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->bindDetailView();
        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }

    protected function bindDetailView()
    {
        Route::bind('announcement_view', function ($value) {
            $announcement = Announcement::find($value);
            event(new ViewPage($announcement));

            return $announcement;
        });

        Route::bind('active_view', function ($value) {
            $active = Active::find($value);
            event(new ViewPage($active));

            return $active;
        });

        Route::bind('course_view', function ($value) {
            $course = Course::find($value);
            event(new ViewPage($course));

            return $course;
        });

        Route::bind('league_view', function ($value) {
            $league = League::find($value);
            event(new ViewPage($league));

            return $league;
        });

        Route::bind('good_view', function ($value) {
            $good = Good::find($value);
            event(new ViewPage($good));

            return $good;
        });

        Route::bind('partime_view', function ($value) {
            $partime = Partime::find($value);
            event(new ViewPage($partime));

            return $partime;
        });
    }
}
