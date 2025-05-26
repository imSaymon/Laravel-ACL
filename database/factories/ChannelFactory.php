<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Channel;
use App\Model;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Channel::class, function (Faker $faker) {
        $name = $faker->word;
    return [
        'name' => $name,
        'description' => $faker->sentence,
        'slug' => Str::slug($name)
    ];
});
