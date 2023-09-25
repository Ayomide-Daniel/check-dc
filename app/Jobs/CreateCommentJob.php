<?php

namespace App\Jobs;

use App\Services\CommentsService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateCommentJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(
        private int $storyId,
        private int $hackerNewsCommentId
    ) {
    }

    /**
     * Execute the job.
     */
    public function handle(
        CommentsService $commentsService,
    ): void {
        $commentsService->createFromHackerNewsId($this->storyId, $this->hackerNewsCommentId);
    }
}
