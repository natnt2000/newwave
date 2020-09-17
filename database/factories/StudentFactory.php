<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Student;
use App\Models\User;
use Faker\Generator as Faker;

$factory->define(Student::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class)->create()->id,
        'fullname' => User::orderBy('id', 'desc')->first()->name,
        'gender' => $faker->numberBetween(1, 2),
        'birthday' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'address' => $faker->address(),
        'phone_number' => $faker->regexify('(03|09|07|08)[0-9]{8}'),
        'avatar' => $faker->image($dir = 'public/storage/images/avatars', $width = 600, $height = 600, 'people', false, false, 'Faker'),
        'status' => $faker->numberBetween(0, 1),
        'faculty_id' => $faker->numberBetween(1, 5)
    ];
});
