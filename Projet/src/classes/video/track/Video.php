<?php

namespace iutnc\netVOD\video\track;

use Exception;

class video
{
    /**
     * @param string $titre;
     * @param int $duree;
     * @param string $resume;
     * @param string $source;
     * @param string $image;
     * @param array $type;
     * @param array $genre;
     */

    public function __construct(string $title, int $duration,string $resume, string $source, array $type, array $genre) {
        $this->titre = $title;
        $this->duree = $duration;
        $this->resume = $resume;
        $this->source = $source;
        $this->type = $type;
        $this->genre = $genre;
    }

    public function __get( string $attr) : mixed {
        if (property_exists($this, $attr)) return $this->$attr;
        else {
            throw new Exception("$attr : invalid property");}
    }

    public function __set( string $attr, mixed $val) : void {
        if (property_exists($this, $attr)) $this->$attr = $val;
        throw new Exception("$attr : invalid property");
    }

}