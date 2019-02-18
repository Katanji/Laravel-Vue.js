<?php
declare(strict_types = 1);

use Faker\Generator as Faker;

$factory->define(App\User::class, function (Faker $faker) {

    $sex = $faker->randomElement(['male', 'female']);

    return [
        'name'             => $sex === 'male' ? $faker->firstNameMale : $faker->firstNameFemale,
        'email'            => $faker->unique()->safeEmail,
        'password'         => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token'   => str_random(10),
        'nickname'         => $faker->unique()->name,
        'surname'          => $faker->lastName,
        'phone'            => $faker->unique()->numberBetween(0000000000, 9999999999),
        'sex'              => $sex,
        'newsletter_agree' => $faker->randomElement([true, false]),
    ];
});
