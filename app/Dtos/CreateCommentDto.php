<?php

namespace App\Dtos;

use Illuminate\Contracts\Support\Arrayable;

Class CreateCommentDto implements Arrayable
{
    public function __construct(
        public int $user_id,
        public int $hacker_news_id,
        public string $kids,
        public int $story_id,
        public string $text,
        public int $time,
        public ?int $parent_id,
    ) {
    }

    function toArray(): array
    {
        $response = [
            'user_id' => $this->user_id,
            'hacker_news_id' => $this->hacker_news_id,
            'kids' => $this->kids,
            'story_id' => $this->story_id,
            'text' => $this->text,
            'time' => $this->time,
        ];

        if ($this->parent_id) {
            $response['parent_id'] = $this->parent_id;
        }

        return $response;
    }
}

?>