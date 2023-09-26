<?php

namespace App\Services;

use App\Dtos\CreateStoryDto;
use App\Dtos\QueryStoryDto;
use App\Interfaces\IHackerNewsService;
use App\Jobs\CreateCommentJob;
use App\Jobs\CreateStoryJob;
use App\Models\Story;
use App\Services\External\HackerNewsService;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class StoryService
{
    public function __construct(
        // private IHackerNewsService $hackerNewsService,
        private Story $storyRepo,
        private UsersService $usersService,
        private HackerNewsService $hackerNewsService,
    ) {
    }

    public function spoolHackerNews(): string
    {
        $spooledStoryIds = $this->hackerNewsService->getTopStories();

        foreach ($spooledStoryIds as $key => $spooledStoryId) {
            CreateStoryJob::dispatch($spooledStoryId);
        }

        return 'Jobs dispatched';
    }

    function create(CreateStoryDto $createStoryDto): Story
    {
        $story = $this->storyRepo->where('hacker_news_id', $createStoryDto->hacker_news_id)->first();

        if ($story) {
            return $story;
        }

        return $this->storyRepo->create($createStoryDto->toArray());
    }

    function createFromHackerNewsId(int $hackerNewsId): ?Story
    {
        $hackerNewsStory = $this->hackerNewsService->getItem($hackerNewsId);

        if($hackerNewsStory['type'] !== 'story' || (isset($hackerNewsStory['deleted']) && $hackerNewsStory['deleted'])) {
            return null;
        }

        $user = $this->usersService->findByHackerNewsIdOrCreate($hackerNewsStory['by']);

        $createStoryDto = new CreateStoryDto(
            $user->id,
            $hackerNewsStory['descendants'],
            $hackerNewsStory['id'],
            json_encode($hackerNewsStory['kids'] ?? (object) []),
            $hackerNewsStory['score'],
            $hackerNewsStory['time'],
            $hackerNewsStory['title'],
            $hackerNewsStory['url'],
            'default',
        );

        $story = $this->create($createStoryDto);

        foreach (($hackerNewsStory['kids'] ?? []) as $key => $commentId) {
            CreateCommentJob::dispatch($story->id, $commentId);
        }

        return $story;
    }

    function findOneBy(QueryStoryDto $query): Story
    {
        $story = $this->storyRepo->where($query->toArray())->first();

        if (!$story) {
            throw new NotFoundHttpException('Story not found');
        }

        return $story;
    }

    /**
     * @return Collection<Story>
     */
    function findBy(QueryStoryDto $query): Collection
    {
        return $this->storyRepo->where($query->toArray())->get();
    }
}