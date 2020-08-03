<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Technician;
use Faker\Generator as Faker;

$factory->define(Technician::class, function (Faker $faker) {
    $result = '';
    for($i = 0; $i < 9; $i++) {
        $result .= mt_rand(0, 9);
    }
    return [
        'fname' => $faker->firstName,
        'lname' => $faker->lastName,
        'zone' => $faker->randomElement(['mazimbu', 'mindu', 'sabasaba', 'kihonda', 'boma', 'msanvu']),
        'gender' => $faker->randomElement(['M', 'F']),
        'phone' => '+255'.$result,
        'email' => strtolower($faker->lexify('???')) . '@gmail.com',
        'api_token' => bin2hex(openssl_random_pseudo_bytes(30))
    ];
});
