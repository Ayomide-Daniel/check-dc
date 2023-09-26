<?php

namespace App\Interfaces;

interface IHackerNewsService
{
    public function getTopStories(): array;

    public function getStory(int $id): array;

    public function getComment(int $id): array;

    public function getUser(string $id): array;
}

?>