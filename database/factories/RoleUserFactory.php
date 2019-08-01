<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\RoleUser;
use Faker\Generator as Faker;

$factory->define(RoleUser::class, function (Faker $faker) {
    return [
        'role_id' => rand(1,\App\Role::count()),
    ];
});
