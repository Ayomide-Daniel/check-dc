<?php

namespace App\Http\Controllers;

use App\Dtos\QueryCommentDto;
use App\Http\Requests\QueryCommentRequest;
use App\Services\CommentsService;

class CommentsController extends Controller
{
    public function __construct(
        private CommentsService $commentsService,
    ) {
    }

    function index(QueryCommentRequest $request) {
        $validatedRequest = $request->validated();

        $comments = $this->commentsService->findBy(new QueryCommentDto(
            $validatedRequest['id'] ?? null,
            $validatedRequest['user_id'] ?? null,
            $validatedRequest['hacker_news_id'] ?? null,
            $validatedRequest['story_id'] ?? null,
            $validatedRequest['parent_id'] ?? null,
        ));

        return response()->json([
            'data' => $comments,
        ]);
    }

    function show(int $id) {
        $comment = $this->commentsService->findOneByOrFail(new QueryCommentDto(
            $id,
        ));

        return response()->json([
            'data' => $comment,
        ]);
    }
}
