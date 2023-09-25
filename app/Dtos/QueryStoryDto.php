<?php

namespace App\Dtos;

use Illuminate\Contracts\Support\Arrayable;

Class QueryStoryDto implements Arrayable
{
    public function __construct(
        public ?int $id = null,
        public ?int $user_id = null,
        public ?int $descendants = null,
        public ?string $hacker_news_id = null,
        public ?string $kids = null,
        public ?string $score = null,
        public ?string $time = null,
        public ?string $title = null,
        public ?string $url = null,
        public ?string $category = null,
    ) {
    }

    public function toArray(): array
    {
        $response= [];

        if ($this->user_id) {
            $response['user_id'] = $this->user_id;
        }

        if ($this->descendants) {
            $response['descendants'] = $this->descendants;
        }

        if ($this->hacker_news_id) {
            $response['hacker_news_id'] = $this->hacker_news_id;
        }

        if ($this->kids) {
            $response['kids'] = $this->kids;
        }

        if ($this->score) {
            $response['score'] = $this->score;
        }

        if ($this->time) {
            $response['time'] = $this->time;
        }

        if ($this->title) {
            $response['title'] = $this->title;
        }

        if ($this->url) {
            $response['url'] = $this->url;
        }

        if ($this->category) {
            $response['category'] = $this->category;
        }

        return $response;
    }
}

?>