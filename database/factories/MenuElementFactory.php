<?php

/** @var Factory $factory */

use App\Models\Menu\MenuElement;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(MenuElement::class, function (Faker $faker) {
    return [
        'name' => $faker->words(rand(2, 4), true),
        'parent_id' => 0,
    ];
});
