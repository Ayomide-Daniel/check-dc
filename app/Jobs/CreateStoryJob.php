<?php

namespace App\Jobs;

use App\Services\StoryService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateStoryJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private int $hackerNewsStoryId
    ) {
    }

    /**
     * Execute the job.
     */
    public function handle(
        StoryService $storyService,
    ): void {
        $storyService->createFromHackerNewsId($this->hackerNewsStoryId);
    }
}
