<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Inbox;
use Faker\Generator as Faker;

$factory->define(Inbox::class, function (Faker $faker) {
    return [
        'sender_email' => $faker->email,
        'sender_name' => $faker->name,
        'subject' => $faker->realText(70),
        'body' => $faker->paragraph(70),
        'html' => $faker->randomHtml(),
        'number' => 123,
        'uid' => 123,
        'received_at' => now()->subSeconds(rand(1000, 10000)),
    ];
});
