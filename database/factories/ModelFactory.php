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
        'widget_id' => $faker->numberBetween($min = 1, $max = 4),

    ];
});



$factory->define(App\Blue::class, function (Faker\Generator $faker) {

        $uniqueWord = $faker->unique()->word;
        $slug = str_slug($uniqueWord, "-");

    return [
        'blue_name' => $uniqueWord,
        'slug' => $slug,

    ];
});

$factory->define(App\LittleRed::class, function (Faker\Generator $faker) {

       $uniqueWord = $faker->unique()->word;
        $slug = str_slug($uniqueWord, "-");

    return [
        'little_red_name' => $uniqueWord,
        'blue_id' => $faker->numberBetween($min = 1, $max = 4),
        'slug' => $slug,

    ];
});