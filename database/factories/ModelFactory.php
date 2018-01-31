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
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'slug' => $faker->word,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Survey::class, function (Faker\Generator $faker) {
    $name = $faker->streetName;
    return [
        'user_id' => function () {
            return factory('App\User')->create()->id;
        },
        'name' => $name,
        'slug' => str_slug($name)
    ];
});

$factory->define(App\Question::class, function (Faker\Generator $faker) {
    return [
        'question' => $faker->sentence . "?"
    ];
});

$factory->define(App\Option::class, function (Faker\Generator $faker) {
    $option = $faker->word;
    return [
        'question_id' => function () {
            return factory('App\Question')->create()->id;
        },
        'label' => $option,
        'value' => $option
    ];
});

$factory->define(App\PasswordReset::class, function () {
    return [];
});
