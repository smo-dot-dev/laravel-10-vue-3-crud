<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Faker\Factory as Faker;

class CreateCourseTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     */
    public function test_create_course(): void
    {
        $faker = Faker::create();
        $courseData = [
            'title' => $faker->sentence,
            'description' => $faker->paragraph,
            'video_url' => $faker->url,
            'video_duration' => $faker->randomDigitNotNull + 1400,
        ];

        $response = $this->postJson('/api/courses', $courseData);
        $response->assertStatus(201);
    }
}
