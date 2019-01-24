<?php

use Faker\Generator as Faker;

$factory->define(App\Equipo::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(1,false)
    ];
});
