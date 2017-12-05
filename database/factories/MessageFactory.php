<?php

use Faker\Generator as Faker;

$factory->define(App\Message::class, function (Faker $faker) {
    return [
        'subject' => $faker->word,
        'content' => $faker->sentence,
        'is_read' => 0,
    ];
});
