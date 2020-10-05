<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Faculty;
use Faker\Generator as Faker;

$factory->define(Faculty::class, function (Faker $faker) {
    $name = $faker->name;
    $slug = \Illuminate\Support\Str::slug($name, '-') . '-' . uniqid('faculty');
    return [
        'name' => $name,
        'slug' => $slug
    ];
});
