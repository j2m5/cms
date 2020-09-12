<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\BlogComment;
use Faker\Generator as Faker;

$factory->define(BlogComment::class, function (Faker $faker) {
    $txt = $faker->realText(rand(50, 250));
    $createdAt = $faker->dateTimeBetween('-2 months', '-1 days');
    $rand = mt_rand(1, 3);

    return [
        'post_id' => rand(1, 100),
        'parent_id' => 0,
        'user_id' => 1,
        'content' => $txt,
        'created_at' => $createdAt,
        'updated_at' => $createdAt,
        'deleted_at' => ($rand === 3) ? $createdAt : null
    ];
});
