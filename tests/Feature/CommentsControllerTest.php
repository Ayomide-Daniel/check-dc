<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Interfaces\IHackerNewsService;
use App\Services\External\Mock\MockHackerNewsService;

class CommentsControllerTest extends TestCase
{

    public function setUp(): void
    {
        parent::setUp();

        $this->app->bind(IHackerNewsService::class, MockHackerNewsService::class);

        $this->artisan('spool:hacker-news')->assertExitCode(0);
    }

    public function test_index(): void
    {
        $response = $this->get('/api/comments');

        $response->assertStatus(200);
    }


    public function test_find_by(): void
    {
        $response = $this->get('/api/comments?id=1');

        $response->assertStatus(200);
    }

    public function test_show(): void
    {
        $response = $this->get('/api/comments/1');

        $response->assertStatus(200);
    }

    public function test_show_not_found(): void
    {
        $response = $this->get('/api/comments/29');

        $response->assertStatus(404);
    }
}
