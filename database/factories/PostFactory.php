<?php

use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(App\Post::class, function (Faker $faker) {
    return [

    //'postsID'=> $faker->,
    'title'=> $faker->sentence(3),
    'published'=>$faker->boolean(100),
    'content' => $faker->text,
    'authors_authorID'=>$faker->numberBetween(1,10),
    'category_categoryID'=>$faker->numberBetween(1,10),
    'image'=>$faker->numberBetween(1,10),
    'publishedDATA'=>now(),
    'description'=> $faker->sentence(3),
    //'postURL'=>$faker->userName,

    ];
});
