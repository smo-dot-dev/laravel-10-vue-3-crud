<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();
        // Let's create 24 courses as an example
        // Same as above, but now use Eloquent and the create method instead of insert
        for ($i = 0; $i < 24; $i++) {
            Course::create([
                'title' => $faker->sentence,
                'description' => $faker->paragraph,
                'video_url' => $faker->url,
                'video_duration' => $faker->randomDigitNotNull + 1400,
            ]);
        }
    }
}
