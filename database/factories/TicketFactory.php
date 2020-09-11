<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Ticket;
use Faker\Generator as Faker;

$factory->define(Ticket::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'category_id' => mt_rand(1, 4),
        'title' => $faker->sentence(rand(3, 20), true),
        'question' => $faker->realText(rand(1000, 4000)),
        'priority' => mt_rand(1, 3),
        'status' => 'opened',
        'created_at' => $faker->dateTimeBetween('-2 months', '-1 days'),
        'updated_at' => $faker->dateTimeBetween('-2 months', '-1 days')
    ];
});
