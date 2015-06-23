<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->defineAs(App\User::class, 'Student', function ($faker) {
    return [
    	'title' => $faker->title,
        'first_name' => $faker->firstName,
        'middle_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->email,
        'personal_email' => $faker->email,
        'personal_phone' => $faker->phoneNumber,
        'password' => bcrypt($faker->password),
        'account_type' => 'Student',
    ];
});

$factory->defineAs(App\User::class, 'Staff', function ($faker) {
    return [
        'title' => $faker->title,
        'first_name' => $faker->firstName,
        'middle_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->unique()->email,
        'personal_email' => $faker->email,
        'personal_phone' => $faker->phoneNumber,
        'password' => bcrypt($faker->password),
        'account_type' => 'Staff',
    ];
});

$factory->define(App\Student::class, function ($faker) {
    return [
    	'dob' => $faker->date,
        'enrolment' => strtoupper($faker->unique()->bothify('???########')),
        'uk_ba_status_id' => $faker->numberBetween($min = 1, $max = 4),
        'award_id' => $faker->numberBetween($min = 1, $max = 3),
        'award_type_id' => $faker->numberBetween($min = 1, $max = 3),
        'enrolment_status_id' => $faker->numberBetween($min = 1, $max = 4),
        'funding_id' => $faker->numberBetween($min = 1, $max = 5),
        'home_address' => $faker->address,
        'current_address' => $faker->address,
        'gender' => randomGender(),
        'nationality' => $faker->country,
        'start' => $faker->date,
    ];
});

$factory->define(App\Staff::class, function ($faker) {
    return [
        'university_phone' => $faker->phoneNumber,
        'about' => $faker->paragraph($nbSentences = 5),
        'room' => $faker->numberBetween($min = 1000, $max = 2999),
    ];
});

function randomGender() {
    $seed = Rand (1,2);
    if ($seed == 1) {
        return 'Male';
    }
    elseif ($seed == 2) {
        return 'Female';
    }
}