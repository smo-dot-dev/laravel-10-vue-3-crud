<?php

namespace Tests\Feature;

use Tests\TestCase;

class ApiRunningTest extends TestCase
{
    /**
     * A basic test example.
     */
    /** @test */
    public function test_api_running_200_ok(): void
    {
        $response = $this->get('/api/courses');

        $response->assertStatus(200);
    }
}
