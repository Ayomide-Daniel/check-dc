<?php

namespace App\Dtos;

use Illuminate\Contracts\Support\Arrayable;

Class QueryUserDto implements Arrayable
{
    public function __construct(
        public ?string $hackerNewsId = null,
        public ?int $created = null,
        public ?int $karma = null,
        public ?string $about = null,
        public ?string $submitted = null,
    ) {
    }

    public function toArray(): array
    {
        $response= [];

        if ($this->hackerNewsId) {
            $response['hacker_news_id'] = $this->hackerNewsId;
        }

        if ($this->created) {
            $response['created'] = $this->created;
        }

        if ($this->karma) {
            $response['karma'] = $this->karma;
        }

        if ($this->about) {
            $response['about'] = $this->about;
        }

        if ($this->submitted) {
            $response['submitted'] = $this->submitted;
        }

        return $response;
    }
}
