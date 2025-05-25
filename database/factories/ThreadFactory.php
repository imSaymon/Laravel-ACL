<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Channel;
use App\Model;
use App\Thread;
use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Thread::class, function (Faker $faker) {
    $title = $faker->sentence;
    return [
        'channel_id' => function() {
            return factory(Channel::class)->create()->id;
        },
        'user_id' => function() {
    return factory(User::class)->create()->id;
        },
        'title' => $title,
        'body' => $faker->paragraph(2),
        'slug' => Str::slug($title)
    ];
});
