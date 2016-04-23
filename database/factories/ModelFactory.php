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





$factory->define(App\Widget::class, function (Faker\Generator $faker) {
    return [
        'widget_name' => $faker->unique()->word,

    ];
});

$factory->define(App\Gadget::class, function (Faker\Generator $faker) {
    return [
        'gadget_name' => $faker->unique()->word,

    ];
});


$factory->define(App\BigDrum::class, function (Faker\Generator $faker) {
    return [
        'big_drum_name' => $faker->unique()->word,

    ];
});



$factory->define(App\BlackHammer::class, function (Faker\Generator $faker) {
    return [
        'black_hammer_name' => $faker->unique()->word,

    ];
});