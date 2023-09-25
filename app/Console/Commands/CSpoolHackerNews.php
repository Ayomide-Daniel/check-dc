<?php

namespace App\Console\Commands;

use App\Services\StoryService;
use Illuminate\Console\Command;

class CSpoolHackerNews extends Command
{
    public function __construct(
        private StoryService $storyService,
    ) {
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
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->storyService->spoolHackerNews();
    }
}
