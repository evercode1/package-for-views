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

$factory->define(App\BigWidget::class, function (Faker\Generator $faker) {
    return [
        'big_widget_name' => $faker->unique()->word,

    ];
});



$factory->define(App\Orange::class, function (Faker\Generator $faker) {
    return [
        'orange_name' => $faker->unique()->word,

    ];
});

$factory->define(App\BigOrange::class, function (Faker\Generator $faker) {
    return [
        'big_orange_name' => $faker->unique()->word,

    ];
});