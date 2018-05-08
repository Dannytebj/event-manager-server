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
use Illuminate\Support\Facades\Hash;

$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name('male'),
        'email' => 'admin@danny.com',
        'phone_number' => $faker->phoneNumber,
        'role' => 1,
        'password' => Hash::make('asd123'),
    ];
});

$factory->define(App\Models\Events::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->text(10),
        'description' => $faker->sentence(15),
        'center_id' => 1,
        'start_date' => $faker->dateTime("now", "WAT"),
        'end_date' => $faker->dateTime('now', 'WAT'),
        'user_id' => 1
    ];
});

$factory->define(App\Models\Center::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->streetName,
        'address' => $faker->address,
        'capacity' => $faker->numberBetween(0, 5000),
        'owner_id' => 1,
        'description' => $faker->sentence(15)
    ];
});
