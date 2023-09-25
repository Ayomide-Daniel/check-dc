<?php

namespace App\Dtos;

use Illuminate\Contracts\Support\Arrayable;

class CreateUserDto implements Arrayable
{
    public function __construct(
        public string $hackerNewsId,
        public int $created,
        public int $karma,
        public string $about,
        public string $submitted,
    ) {
    }

    public function toArray(): array
    {
        return [
            'hacker_news_id' => $this->hackerNewsId,
            'created' => $this->created,
            'karma' => $this->karma,
            'about' => $this->about,
            'submitted' => $this->submitted,
        ];
    }
}
