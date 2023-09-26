<?php

namespace App\Dtos;

use Illuminate\Contracts\Support\Arrayable;

Class QueryCommentDto implements Arrayable
{
    public function __construct(
        public ?int $id = null,
        public ?int $user_id = null,
        public ?int $hacker_news_id = null,
        public ?int $story_id = null,
        public ?int $parent_id = null,
        public ?string $kids = null,
        public ?string $text = null,
        public ?int $time = null,
    ) {
    }

    function toArray(): array
    {
        $response = [];

        if ($this->id) {
            $response['id'] = $this->id;
        }

        if ($this->user_id) {
            $response['user_id'] = $this->user_id;
        }

        if ($this->hacker_news_id) {
            $response['hacker_news_id'] = $this->hacker_news_id;
        }

        if ($this->story_id) {
            $response['story_id'] = $this->story_id;
        }

        if ($this->parent_id) {
            $response['parent_id'] = $this->parent_id;
        }

        if ($this->kids) {
            $response['kids'] = $this->kids;
        }

        if ($this->text) {
            $response['text'] = $this->text;
        }

        if ($this->time) {
            $response['time'] = $this->time;
        }

        return $response;

    }
}

?>