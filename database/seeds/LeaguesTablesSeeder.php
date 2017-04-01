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
        factory(App\Model\League::class, 20)->create();
        factory(App\Model\LeagueGroup::class, 20)->create();
    }
}
