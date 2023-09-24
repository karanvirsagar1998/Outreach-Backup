<?php

use App\Models\Jobs;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

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
            Jobs::create([
                'user_id' => 2,
                'name' => $faker->jobTitle,
                'description' => $faker->randomHtml(4, 5),
            ]);
        }
    }
}
