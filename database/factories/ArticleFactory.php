<?php
declare(strict_types = 1);

use Faker\Generator as Faker;

$factory->define(App\Article::class, function (Faker $faker) {
    return [
        'text' => $faker->paragraph,
    ];
});
