<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Database\Seeders\CourseSeeder;

class ListCoursesTest extends TestCase
{
    use RefreshDatabase;

    //seed
    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    /**
     * A basic feature test example.
     */
    /** @test */
    public function test_list_courses_json_structure(): void
    {
        $this->seed(CourseSeeder::class);

        $response = $this->get('/api/courses');

        $response->assertStatus(200)
            ->assertJsonIsArray()->assertJsonStructure([
                '*' => [
                    'id',
                    'title',
                    'description',
                    'video_url',
                    'video_duration',
                    'created_at',
                    'updated_at',
                ],
            ]);
    }
}
