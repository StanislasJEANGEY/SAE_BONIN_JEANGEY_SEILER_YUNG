<?php

namespace iutnc\netVOD\video\track;

class Episode extends video
{
    public function __construct(string $title, int $duration, int $number, string $source) {
        parent::__construct($title, $duration, $number, $source);
    }
}