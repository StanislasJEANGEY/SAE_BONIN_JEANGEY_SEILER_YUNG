<?php

namespace iutnc\netVOD\video\track;

use Exception;

class video
{
    /**
     * @param string $titre;
     * @param int $duree;
     * @param int $numero;
     * @param string $source;
     * @param string $image;
     */

    public function __construct(string $title, int $duration, int $number, string $source, string $im) {
        $this->titre = $title;
        $this->duree = $duration;
        $this->numero = $number;
        $this->source = $source;
        $this->image = $im;
    }

    public function __get( string $attr) : mixed {
        if (property_exists($this, $attr)) return $this->$attr;
        else {
            throw new Exception("$attr : invalid property");}
    }

}