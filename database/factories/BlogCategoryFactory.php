<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\BlogCategory;
use Faker\Generator as Faker;

$factory->define(BlogCategory::class, function (Faker $faker) {
    $title = $faker->sentence(rand(3, 8), true);
    $text = $faker->realText(rand(50, 250));
    $createdAt = $faker->dateTimeBetween('-2 months', '-1 days');

    $data = [
        'parent_id' => 0,
        'slug' => \Illuminate\Support\Str::random(30),
        'title' => $title,
        'description' => $text,
        'created_at' => $createdAt,
        'updated_at' => $createdAt,
        'deleted_at' => $createdAt
    ];

    return $data;
});
