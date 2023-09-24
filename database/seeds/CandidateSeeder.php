<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use App\Models\Jobs;
use App\Models\Candidate;


class CandidateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        $jobs = Jobs::get()->pluck('id');
        foreach (range(1, 25) as $index) {
            Candidate::create([
                'student_id' => $faker->numberBetween(1,100),
                'job_id' => $faker->randomElement($jobs),
                'rank' => $faker->numberBetween(1, 10),
                'status'=> $faker->randomElement(['NEW', 'ONGOING', 'COMPLETED', 'PENDING REVIEW', 'ARCHIVED', 'SHORTLISTED', 'EXPIRED']),
            ]);
        }
    }
}
