<?php

namespace App\Interfaces;

interface IHackerNewsService
{
    public function getTopStories(): array;

    /**
     * I want to be able to mock this method in my tests
     * 
     * @return array<mixed>
     */
    public function getStory(int $id): array;

    /**
     * I want to be able to mock this method in my tests
     * 
     * @return array<mixed>
     */
    public function getComment(int $id): array;

    public function getUser(string $id): array;
}

?>