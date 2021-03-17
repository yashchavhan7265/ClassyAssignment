<?php
$factory->define(App\Address::class, function (Faker\Generator $faker) {
    return [
        'address1' => $faker->streetName,
        'address2' => $faker->streetAddress,
        'city' => $faker->city,
        'state' => $faker->state,
        'zip' => $faker->postcode,
        'country' => $faker->country,
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        }
    ];
});
