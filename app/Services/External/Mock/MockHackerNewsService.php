<?php

namespace App\Services\External\Mock;

use App\Interfaces\IHackerNewsService;
use Faker\Factory as Faker;


class MockHackerNewsService implements IHackerNewsService
{
    function getTopStories(): array {
        return [
            Faker::create()->randomDigit(),
            Faker::create()->randomDigit(),
            Faker::create()->randomDigit(),
            Faker::create()->randomDigit(),
            Faker::create()->randomDigit(),
        ];
    }

    function getStory(int $id): array {
        return [
            'by' => Faker::create()->name(),
            'descendants' => Faker::create()->randomDigit(),
            'id' => $id,
            'kids' => [
                Faker::create()->randomDigit(),
                Faker::create()->randomDigit(),
                Faker::create()->randomDigit(),
            ],
            'score' => Faker::create()->randomDigit(),
            'time' => Faker::create()->unixTime(),
            'title' => Faker::create()->sentence(),
            'type' => 'story',
            'url' => Faker::create()->url(),
        ];
    }

    function getComment(int $id): array {
        return [
            'by' => Faker::create()->name(),
            'id' => $id,
            'kids' => [
                Faker::create()->randomDigit(),
                Faker::create()->randomDigit(),
                Faker::create()->randomDigit(),
            ],
            'parent' => Faker::create()->randomDigit(),
            'text' => Faker::create()->text(),
            'time' => Faker::create()->unixTime(),
            'type' => 'comment',
        ];
    }

    function getUser(string $id): array {
        return [
            'id' => $id,
            'created' => Faker::create()->unixTime(),
            'karma' => Faker::create()->randomDigit(),
            'submitted' => [
                Faker::create()->randomDigit(),
                Faker::create()->randomDigit(),
                Faker::create()->randomDigit(),
            ],
        ];
    }
}

?>