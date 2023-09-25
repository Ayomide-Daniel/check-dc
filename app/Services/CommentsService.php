<?php

namespace App\Services;

use App\Dtos\CreateCommentDto;
use App\Dtos\QueryStoryDto;
use App\Models\Comment;
use App\Services\External\HackerNewsService;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CommentsService
{
    public function __construct(
        private Comment $commentRepo,
        private StoryService $storyService,
        private HackerNewsService $hackerNewsService,
        private UsersService $usersService,
    ) {
    }

    function create(CreateCommentDto $createCommentDto): Comment
    {
        $comment = $this->commentRepo->where('hacker_news_id', $createCommentDto->hacker_news_id)->first();

        if ($comment) {
            return $comment;
        }

        return $this->commentRepo->create($createCommentDto->toArray());
    }

    function createFromHackerNewsId(int $storyId, int $hackerNewsId): ?Comment {
        $story = $this->storyService->findOneBy(new QueryStoryDto($storyId));

        if (!$story) {
            throw new NotFoundHttpException('Story not found');
        }

        $hackerNewsComment = $this->hackerNewsService->getItem($hackerNewsId);

        if (isset($hackerNewsComment['deleted']) && $hackerNewsComment['deleted']) {
            return null;
        }

        $user = $this->usersService->findByHackerNewsIdOrCreate($hackerNewsComment['by']);

        $createCommentDto = new CreateCommentDto(
            $user->id,
            $hackerNewsComment['id'],
            json_encode($hackerNewsComment['kids'] ?? (object) []),
            $story->id,
            $hackerNewsComment['text'],
            $hackerNewsComment['time'],
        );

        return $this->create($createCommentDto);
    }

}

?>