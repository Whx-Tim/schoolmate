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
        factory(App\Model\Active::class, 20)->create();
        factory(App\Model\ActiveApply::class, 20)->create();
    }
}
