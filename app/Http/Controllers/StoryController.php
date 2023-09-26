<?php

namespace App\Http\Controllers;

use App\Dtos\QueryStoryDto;
use App\Http\Requests\QueryStoryRequest;
use App\Services\StoryService;
use Illuminate\Http\JsonResponse;

class StoryController extends Controller
{
    public function __construct(
        private StoryService $storyService,
    ) {
    }

    function index(QueryStoryRequest $request): JsonResponse {
        $validatedRequest = $request->validated();

        $stories = $this->storyService->findBy(new QueryStoryDto(
            $validatedRequest['id'] ?? null,
            $validatedRequest['user_id'] ?? null,
            null,
            $validatedRequest['hacker_news_id'] ?? null,
        ));

        return response()->json([
            'data' => $stories,
        ]);
    }
}
