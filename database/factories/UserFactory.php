<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\user;
use Faker\Generator as Faker;

$factory->define(user::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'username' => $faker->unique()->userName,
        'password' => bcrypt('password'),
    ];
});
