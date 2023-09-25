<?php

namespace App\Http\Controllers;

use App\Services\StoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SpoolController extends Controller
{
    public function __construct(
        private StoryService $storyService,
    ) {
    }

    function spoolHackerNews() : JsonResponse {
        $message = $this->storyService->spoolHackerNews();
        
        return response()->json([
            'message' => $message,
        ]);
    }
}
