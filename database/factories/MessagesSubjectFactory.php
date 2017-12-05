<?php

use Faker\Generator as Faker;

$factory->define(App\MessagesSubject::class, function (Faker $faker) {
    return [
        'subject' => str_random(30),
    ];
});
