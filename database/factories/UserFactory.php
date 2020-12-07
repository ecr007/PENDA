<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

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

$factory->define(User::class, function (Faker $faker) {
    return [
        'status' => 1,
        'firstname' => $faker->firstname,
        'lastname' => $faker->lastname,
        'slug' => Str::slug($faker->userName),
        'organization' => $faker->company,
        'nickname' => $faker->userName,
        'email' => $faker->unique()->safeEmail,
        'email_verified_at' => now(),
        'phone' => 8889377238,
        'country' => $faker->countryCode,
        'profile_pic_url' => $faker->imageUrl(480,480),
        'signup_invite_code' => Str::random(30),
        'password' => Hash::make('123456'),
        'remember_token' => Str::random(10),
    ];
});
