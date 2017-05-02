<?php

use Illuminate\Database\Seeder;

class ActivesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Model\Active::class, 20)->create()->each(function ($active) {
            $active->announcements()->create(['title' => '活动某某标题', 'content' => '标题随便内容']);
        });
        factory(App\Model\ActiveApply::class, 20)->create();
    }
}
