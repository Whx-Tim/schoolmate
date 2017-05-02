<?php

use Illuminate\Database\Seeder;

class LeaguesTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Model\League::class, 20)->create()->each(function ($league) {
            $league->announcements()->create(['title' => '活动某某标题', 'content' => '标题随便内容']);
        });
        factory(App\Model\LeagueGroup::class, 20)->create();
    }
}
