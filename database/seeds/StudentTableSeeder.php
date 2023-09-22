<?php

use Illuminate\Database\Seeder;
use App\Models\Skillset;
use App\Models\Student;
use Faker\Factory as Faker;

class StudentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $skills = Skillset::get()->pluck('name');

        foreach (range(1, 100) as $index) {
            Student::create([
                'user_id' => 2,
                'first_name' => $faker->firstName,
                'last_name' => $faker->lastName,
                'contact_number' => $faker->phoneNumber,
                'email' => $faker->unique()->safeEmail,
                'link' => $faker->url,
                'about' => $faker->text,
                'skills' => $faker->randomElements($skills, 3),
                'rank' => $faker->numberBetween(1, 10),
                'availability' => $faker->boolean,
                'international' => $faker->boolean,
                'college_id' => $faker->numberBetween(1, 95),
                'college_other' => $faker->optional()->text,
                'video_link' => $faker->url,
                'assessment_results_link' => $faker->url,
                'status' => $faker->randomElement(['ONGOING', 'ARCHIVED', 'SHORTLISTED', 'EXPIRED']),
            ]);
        }
    }
}