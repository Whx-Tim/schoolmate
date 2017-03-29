<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'username' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('123456'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Model\UserInfo::class, function (Faker\Generator $faker) {
    return [
        'name'       => $faker->name,
        'realname'   => '某某某',
        'student_id' => '2013150010',
        'college'    => '计算机与软件',
        'grade'      => $faker->numberBetween(1983, 2017),
        'gender'     => $faker->numberBetween(1, 2),
        'phone'      => '13418866733',
        'user_id'    => function() {
            return factory(App\User::class)->create()->id;
        }
    ];
});

$factory->define(App\Model\Active::class, function (Faker\Generator $faker) {
    return [
        'name' => '某某某活动',
        'time' => $faker->date(),
        'address' => $faker->address,
        'lnt' => $faker->longitude,
        'lat' => $faker->latitude,
        'poster' => $faker->imageUrl(),
        'images' => $faker->imageUrl(),
        'count'  => $faker->numberBetween(1,100),
        'phone'  => $faker->phoneNumber,
        'description' => $faker->paragraph,
        'user_id'  => $faker->numberBetween(1,10)
    ];
});

$factory->define(App\Model\ActiveApply::class, function (Faker\Generator $faker) {
    return [
        'user_id' => $faker->numberBetween(1,40),
        'active_id' => $faker->numberBetween(1,10)
    ];
});

$factory->define(App\Model\Course::class, function (Faker\Generator $faker) {
    return [
        'number' => $faker->numberBetween(10000000,200000000),
        'name'   => $faker->name,
        'teacher' => '某某某',
        'user_id' => $faker->numberBetween(1,10)
    ];
});

$factory->define(App\Model\CourseGroup::class, function (Faker\Generator $faker) {
    return [
        'user_id' => $faker->numberBetween(1,40),
        'course_id' => $faker->numberBetween(1,10)
    ];
});

