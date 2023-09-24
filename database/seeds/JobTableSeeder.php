<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class JobTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1, 20) as $index) {
            \App\Models\Jobs::create([
                'user_id' => 2,
                'name' => $faker->jobTitle,
                'description' => $faker->randomHtml(4, 5),
            ]);
        }
    }
}