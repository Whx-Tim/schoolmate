<?php

use Illuminate\Database\Seeder;

class PartimesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Model\Partime::class, 20)->create();
    }
}
