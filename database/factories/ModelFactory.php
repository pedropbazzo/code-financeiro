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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
use Faker\Generator;

$factory->define(CodeFinance\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

/* Definindo um estado como 'admin' */
$factory->state(CodeFinance\Models\User::class, 'admin', function (Faker\Generator $faker) {
    return [
        'role' => \CodeFinance\Models\User::ROLE_ADMIN
    ];
});

$factory->state(CodeFinance\Models\User::class, 'client', function (Faker\Generator $faker) {
    return [
        'role' => \CodeFinance\Models\User::ROLE_CLIENT
    ];
});

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(CodeFinance\Models\Bank::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'logo' => md5(time()) . '.jpeg',
    ];
});