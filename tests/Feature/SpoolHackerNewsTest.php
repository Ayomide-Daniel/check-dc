<?php

namespace Tests\Feature;

use App\Interfaces\IHackerNewsService;
use App\Services\CommentsService;
use App\Services\External\Mock\MockHackerNewsService;
use App\Services\StoryService;
use App\Services\UsersService;
use Tests\TestCase;

class SpoolHackerNewsTest extends TestCase
{
    private StoryService $storyService;

    private UsersService $usersService;

    private CommentsService $commentsService;


    public function setUp(): void
    {
        parent::setUp();

        $this->app->bind(IHackerNewsService::class, MockHackerNewsService::class);

        $this->storyService = $this->app->make(StoryService::class);
        $this->usersService = $this->app->make(UsersService::class);
        $this->commentsService = $this->app->make(CommentsService::class);
    }

    public function test_handle(): void
    {
        $this->artisan('spool:hacker-news')->assertExitCode(0);

        $users = $this->usersService->findAll();
        $this->assertGreaterThan(0, $users->count());

        $stories = $this->storyService->findAll();
        $this->assertGreaterThan(0, $stories->count());


        $comments = $this->commentsService->findAll();
        $this->assertGreaterThan(0, $comments->count());
    }
}
