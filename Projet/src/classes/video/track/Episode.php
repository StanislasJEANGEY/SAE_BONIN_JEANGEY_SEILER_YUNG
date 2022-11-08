<?php

namespace iutnc\netVOD\video\track;

class Episode extends video
{
    protected $idSaison;

    public function __construct(string $title, int $duration,string $resume, string $source, array $type, array $genre, int $idS) {
        parent::__construct($title, $duration,$resume, $source, $type, $genre);
        $this->idSaison = $idS;
    }
}