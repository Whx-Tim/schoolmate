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
        factory(App\Model\Course::class, 20)->create()->each(function ($course) {
            $course->announcements()->create(['title' => '活动某某标题', 'content' => '标题随便内容']);
        });
        factory(App\Model\CourseGroup::class, 20)->create();
    }
}
