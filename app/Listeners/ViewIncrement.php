<?php

namespace App\Listeners;

use App\Events\ViewPage;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class ViewIncrement
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ViewPage  $event
     * @return void
     */
    public function handle(ViewPage $event)
    {
        $model = $event->model;
        if ($model->view) {
            $model->view()->increment('count');
        } else {
            $model->view()->create(['count' => 0]);
        }
    }
}
