<?php

namespace Tests\Feature;

use App\Interfaces\IHackerNewsService;
use App\Services\External\Mock\MockHackerNewsService;
use Tests\TestCase;

class UsersControllerTest extends TestCase
{
    public function setUp(): void
    {
        parent::setUp();

        $this->app->bind(IHackerNewsService::class, MockHackerNewsService::class);

        $this->artisan('spool:hacker-news')->assertExitCode(0);
    }

    public function test_index(): void
    {
        $response = $this->get('/api/users');

        $response->assertStatus(200);
    }


    public function test_find_by(): void
    {
        $response = $this->get('/api/users?id=1');

        $response->assertStatus(200);
    }

    public function test_show(): void
    {
        $response = $this->get('/api/users/1');

        $response->assertStatus(200);
    }

    public function test_show_not_found(): void
    {
        $response = $this->get('/api/users/29');

        $response->assertStatus(404);
    }
}
