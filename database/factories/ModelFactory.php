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
$factory->define(App\Models\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'avatar_link' => str_random(10),
        'remember_token' => str_random(10),
    ];
});
$factory->define(App\Models\Document::class, function (Faker\Generator $faker) {
    return [
        'item_id' => rand(1, 20),
        'doc_type_id' => rand(5, 20),
        'limit' => str_random(20),
        'description' => $faker->paragraph(20),
        'fields' => str_random(20),
        'notation' => str_random(10),
        'publish_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'start_date' => $faker->date($format = 'Y-m-d', $max = 'now'),
        'effective' => str_random(10),
        'source' => str_random(20),
        'content' => $faker->paragraph(30),
        'confirmed' => rand(0, 1)
    ];
});
$factory->define(App\Models\RelatedDocument::class, function(Faker\Generator $faker) {
    return [
        'document_id' => function () {
            return App\Models\Document::inRandomOrder()->first()->id;
        },
        'guide_doc_id' => function () {
            return App\Models\Document::inRandomOrder()->first()->id;
        },
        'base_doc_id' => function () {
            return App\Models\Document::inRandomOrder()->first()->id;
        }
    ];
});
