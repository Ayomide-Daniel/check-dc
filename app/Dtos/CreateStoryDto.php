<?php

namespace App\Dtos;

use Illuminate\Contracts\Support\Arrayable;

Class CreateStoryDto implements Arrayable
{
    public function __construct(
        public int $user_id,
        public int $descendants,
        public string $hacker_news_id,
        public string $kids,
        public string $score,
        public string $time,
        public string $title,
        public string $url,
        public string $category,        
    ) {
    }

    function toArray(): array
    {
        return [
            'user_id' => $this->user_id,
            'descendants' => $this->descendants,
            'hacker_news_id' => $this->hacker_news_id,
            'kids' => $this->kids,
            'score' => $this->score,
            'time' => $this->time,
            'title' => $this->title,
            'url' => $this->url,
            'category' => $this->category,
        ];
    }
}

?>