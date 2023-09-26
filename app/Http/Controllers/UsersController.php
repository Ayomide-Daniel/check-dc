<?php

namespace App\Http\Controllers;

use App\Dtos\QueryUserDto;
use App\Http\Requests\QueryUserRequest;
use App\Services\UsersService;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function __construct(
        private UsersService $usersService,
    ) {
    }

    function index(QueryUserRequest $request) {
        $validatedRequest = $request->validated();

        $users = $this->usersService->findBy(new QueryUserDto(
            $validatedRequest['id'] ?? null,
            $validatedRequest['hacker_news_id'] ?? null,
        ));

        return response()->json([
            'data' => $users,
        ]);
    }
}
