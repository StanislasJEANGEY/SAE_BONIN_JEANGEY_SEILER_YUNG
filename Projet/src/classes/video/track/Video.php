<?php

namespace iutnc\netVOD\video\track;

use Exception;

class video
{
    /**
     * @param string $id
     * @param string $titre;
     * @param int $duree;
     * @param string $resume;
     * @param string $source;
     */

    public function __construct(string $id, string $title, int $duration,string $resume, string $source) {
        $this->id = $id;
        $this->titre = $title;
        $this->duree = $duration;
        $this->resume = $resume;
        $this->source = $source;
    }





}