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

$factory->define(App\Models\Admin\User::class, function (Faker\Generator $faker) {
    return [
        'username'       => $faker->userName,
        'firstname'      => $faker->firstName,
        'lastname'       => $faker->lastName,
        'email'          => $faker->safeEmail,
        'password'       => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
        'superadmin'     => $faker->boolean(50)
    ];
});

$factory->define(App\Models\Geo\Barrio::class, function(Faker\Generator $faker) {
    return [
        'nombre' => $faker->city
    ];
});
