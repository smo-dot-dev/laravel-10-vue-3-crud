<?php

namespace Tests\Feature;

use Database\Seeders\CourseSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DeleteCourseTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     */
    public function test_delete_course(): void
    {
        $this->seed(CourseSeeder::class);
        // Get id from last course created
        $id = \App\Models\Course::latest()->first()->id;
        $response = $this->deleteJson("/api/courses/$id");
        $response->assertStatus(204);
    }
}
