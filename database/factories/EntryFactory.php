<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Entry;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

$factory->define(Entry::class, function (Faker $faker) {
    return [
        'power_phrase' => Str::random(10),
        'source' => Str::random(10),
        'episode' => Str::random(10),
        'user_id' => 1,
    ];
});
