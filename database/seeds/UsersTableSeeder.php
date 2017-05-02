<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Model\UserInfo::class, 40)->create()->each(function ($user) {
            $user->announcements()->create(['title' => '系统公告标题', 'content' => '系统公告内容']);
        });
    }
}
