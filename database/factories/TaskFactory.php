<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Task;
use Faker\Generator as Faker;

$factory->define(Task::class, static function (Faker $faker) {
    return [
        'title' => $faker->title,
        'description' => $faker->text
    ];
});
