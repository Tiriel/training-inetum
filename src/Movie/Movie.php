<?php

namespace App\Movie;

use App\Trait\ToStringTrait;

class Movie
{
    use ToStringTrait;

    public function __construct(
        protected string $title,
        protected \DateTimeImmutable $releasedAt,
    ) {
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): Movie
    {
        $this->title = $title;
        return $this;
    }

    public function getReleasedAt(): DateTimeImmutable
    {
        return $this->releasedAt;
    }

    public function setReleasedAt(DateTimeImmutable $releasedAt): Movie
    {
        $this->releasedAt = $releasedAt;
        return $this;
    }
}
