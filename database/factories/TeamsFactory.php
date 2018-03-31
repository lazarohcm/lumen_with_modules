<?php

$factory->define(\App\Modules\Teams\Models\Team::class, function (Faker\Generator $faker) use ($factory) {

    return [
        'name' => $faker->name,
        'description' => $faker->sentences(2, true),
        'users_id' => $factory->create(\App\Modules\Users\Models\User::class)->id
    ];
});