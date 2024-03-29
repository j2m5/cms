<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Page;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Page::class, function (Faker $faker) {
    $title = $faker->sentence(rand(3, 8), true);
    $txt = $faker->realText(rand(1000, 4000));
    $isPublic = 1;
    $createdAt = $faker->dateTimeBetween('-2 months', '-1 days');
    $rand = mt_rand(1, 3);

    return [
        'user_id' => 1,
        'title' => $title,
        'slug' => Str::slug($title).'-'.Str::random(50),
        'content' => $txt,
        'is_public' => $isPublic,
        'created_at' => $createdAt,
        'updated_at' => $createdAt,
        'deleted_at' => ($rand === 3) ? $createdAt : null
    ];
});
