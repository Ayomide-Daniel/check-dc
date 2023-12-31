<?php

namespace App\Services\External;

use App\Interfaces\IHackerNewsService;
use Illuminate\Support\Facades\Http;

class HackerNewsService implements IHackerNewsService
{
    public function __construct(
        private Http $client,
    ) {
    }

    /**
     * @return array<int>
     */
    function getTopStories(): array {
        $response = $this->client::get('https://hacker-news.firebaseio.com/v0/topstories.json');
        return $response->json();
    }

    /**
     * I want to be able to mock this method in my tests
     * 
     * @return array<mixed>
     */
    function getStory(int $id): array {
        return $this->getItem($id);
    }

    /**
     * I want to be able to mock this method in my tests
     * 
     * @return array<mixed>
     */
    function getComment(int $id): array {
        return $this->getItem($id);
    }

    /**
     * @return array<mixed>
     */
    function getItem(int $id): array {
        $response = $this->client::get("https://hacker-news.firebaseio.com/v0/item/$id.json");
        return $response->json();
    }

    /**
     * @return array<mixed>
     */
    function getUser(string $id): array
    {
        $response = $this->client::get("https://hacker-news.firebaseio.com/v0/user/$id.json");
        return $response->json();
    }
}
