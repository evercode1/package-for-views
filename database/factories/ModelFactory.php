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

















































// Begin Subcategory Factory

$factory->define(App\Subcategory::class, function (Faker\Generator $faker) {
    return [
        'subcategory_name' => $faker->unique()->word,
        'category_id' => $faker->numberBetween($min = 1, $max = 4),

    ];
});

// End Subcategory Routes



// Begin Gadget Factory

$factory->define(App\Gadget::class, function (Faker\Generator $faker) {
    return [
        'gadget_name' => $faker->unique()->word,
        'widget_id' => $faker->numberBetween($min = 1, $max = 4),

    ];
});

// End Gadget Routes



// Begin Gadget Factory

$factory->define(App\Gadget::class, function (Faker\Generator $faker) {
    return [
        'gadget_name' => $faker->unique()->word,
        'widget_id' => $faker->numberBetween($min = 1, $max = 4),

    ];
});

// End Gadget Routes

// Begin Gadget Factory

$factory->define(App\Gadget::class, function (Faker\Generator $faker) {
    return [
        'gadget_name' => $faker->unique()->word,
        'widget_id' => $faker->numberBetween($min = 1, $max = 4),

    ];
});

// End Gadget Routes

// Begin Gadget Factory

$factory->define(App\Gadget::class, function (Faker\Generator $faker) {
    return [
        'gadget_name' => $faker->unique()->word,
        'widget_id' => $faker->numberBetween($min = 1, $max = 4),

    ];
});

// End Gadget Routes

// Begin Gadget Factory

$factory->define(App\Gadget::class, function (Faker\Generator $faker) {
    return [
        'gadget_name' => $faker->unique()->word,
        'widget_id' => $faker->numberBetween($min = 1, $max = 4),

    ];
});

// End Gadget Routes

// Begin Gadget Factory

$factory->define(App\Gadget::class, function (Faker\Generator $faker) {
    return [
        'gadget_name' => $faker->unique()->word,
        'widget_id' => $faker->numberBetween($min = 1, $max = 4),

    ];
});

// End Gadget Routes

// Begin Gadget Factory

$factory->define(App\Gadget::class, function (Faker\Generator $faker) {
    return [
        'gadget_name' => $faker->unique()->word,
        'widget_id' => $faker->numberBetween($min = 1, $max = 4),

    ];
});

// End Gadget Routes