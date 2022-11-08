<?php

namespace iutnc\netVOD\video\track;

class Episode extends video
{
    public function __construct(string $title, int $duration,string $resume, string $source, string $im, array $type, array $genre) {
        parent::__construct($title, $duration,$resume, $source, $im, $type, $genre);
    }
}