<?php

use Illuminate\Database\Seeder;

class CoursesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Model\Course::class, 20)->create();
        factory(App\Model\CourseGroup::class, 20)->create();
    }
}
