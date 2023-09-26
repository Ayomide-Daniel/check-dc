<?php

namespace App\Services;

use App\Dtos\CreateCommentDto;
use App\Dtos\QueryCommentDto;
use App\Dtos\QueryStoryDto;
use App\Interfaces\IHackerNewsService;
use App\Jobs\CreateCommentJob;
use App\Models\Comment;
use Illuminate\Database\Eloquent\Collection;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class CommentsService
{
    public function __construct(
        private Comment $commentRepo,
        private StoryService $storyService,
        private IHackerNewsService $hackerNewsService,
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

    function createFromHackerNewsId(int $storyId, int $hackerNewsId, ?int $parentId): ?Comment
    {
        $story = $this->storyService->findOneBy(new QueryStoryDto($storyId));

        if (!$story) {
            throw new NotFoundHttpException('Story not found');
        }

        if ($parentId) {
            $parentComment = $this->commentRepo->where('id', $parentId)->first();

            if (!$parentComment) {
                throw new NotFoundHttpException('Parent comment not found');
            }
        }

        $hackerNewsComment = $this->hackerNewsService->getComment($hackerNewsId);

        if ($hackerNewsComment['type'] !== 'comment' || (isset($hackerNewsComment['deleted']) && $hackerNewsComment['deleted'])) {
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
            $parentId,
        );

        $comment = $this->create($createCommentDto);

        foreach (($hackerNewsComment['kids'] ?? []) as $key => $value) {
            if ($parentId) {
                CreateCommentJob::dispatch($story->id, $value, $comment->id);
            }
        }
        return $comment;
    }

    /**
     * @return Collection<Comment>
     */
    function findAll(): Collection
    {
        return $this->commentRepo->all();
    }

    /**
     * @return Collection<Comment>
     */
    function findBy(QueryCommentDto $query): Collection
    {
        return $this->commentRepo->where($query->toArray())->get();
    }

    function findOneByOrFail(QueryCommentDto $query): Comment
    {
        $comment = $this->commentRepo->where($query->toArray())->with(['user', 'story'])->first();

        if (!$comment) {
            throw new NotFoundHttpException('Comment not found');
        }

        return $comment;
    }
}
