<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->safeEmail,
        'username' => $faker->userName,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

/*$factory->define(App\Spa::class, function (Faker\Generator $faker) {
    return [
        'spa_name' => $faker->name,
        'spa_description' => $faker->paragraphs(1),
        'spa_address' => $faker->address,
        'spa_phone' => $faker->phoneNumber,
        'spa_email' => $faker->email,
        'spa_hours' => $faker->amPm
    ];
});*/

$factory->define(App\Rating::class, function (Faker\Generator $faker) {
    return [
        'id' => rand(1,30),
        'spa_id' => rand(1,40),
        'user_id' => rand(1,4),
        'comment' => $faker->paragraphs(1),
    ];
});