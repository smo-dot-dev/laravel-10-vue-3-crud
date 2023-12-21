<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Database\Seeders\CourseSeeder;
use Tests\TestCase;

class UpdateCourseTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_update_course_title(): void
    {
        $this->seed(CourseSeeder::class);

        // Get id from last course created
        $id = \App\Models\Course::latest()->first()->id;

        $courseData = [
            'title' => 'This is nothing but a drill',
            'description' => 'This is a description',
            'video_url' => 'http://localhost',
            'video_duration' => 0,

        ];
        $response = $this->putJson('/api/courses/' . $id, $courseData);
        $response->assertStatus(200);
    }
}
