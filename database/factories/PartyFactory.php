<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Party;
use Faker\Generator as Faker;

$factory->define(Party::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'no_of_members' => rand(5, 10),
    ];
});
