<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Task;
use Faker\Generator as Faker;

$factory->define(Task::class, function (Faker $faker) {
    $date = $faker->dateTimeThisDecade;
    return [
        'type_id' => rand(1,3),
        'name' => $faker->sentence,
        'detail' => $faker->paragraph,
        'created_at' => $date,
        'updated_at' => $date
    ];
});
