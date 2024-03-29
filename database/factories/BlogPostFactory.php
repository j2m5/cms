<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\BlogPost;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(BlogPost::class, function (Faker $faker) {
    $title = $faker->sentence(rand(3, 8), true);
    $txt = $faker->realText(rand(1000, 4000));
    $isPublic = 1;
    $createdAt = $faker->dateTimeBetween('-2 months', '-1 days');
    $rand = mt_rand(1, 3);

    return [
        'category_id' => 1,
        'user_id' => 1,
        'title' => $title,
        'slug' => Str::slug($title).'-'.Str::random(50),
        'excerpt' => $faker->text(rand(40, 100)),
        'content' => $txt,
        'is_public' => $isPublic,
        'created_at' => $createdAt,
        'updated_at' => $createdAt,
        'deleted_at' => ($rand === 3) ? $createdAt : null
    ];
});
