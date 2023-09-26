<?php

namespace App\Console\Commands;

use App\Services\StoryService;
use Illuminate\Console\Command;

class CSpoolHackerNews extends Command
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'spool:hacker-news';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Spools the top 500 stories from Hacker News';

    /**
     * Execute the console command.
     */
    public function handle(
        StoryService $storyService,
    ) {
        $response = $storyService->spoolHackerNews();

        $this->info($response);
    }
}
