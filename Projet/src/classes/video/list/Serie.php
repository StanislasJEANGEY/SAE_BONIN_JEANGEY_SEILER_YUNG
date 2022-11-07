<?php
namespace iutnc\netVOD\video\list;

use Exception;

class Serie {
    protected array $episodes;
    protected int $nbSaison;
    protected string $genre;
    protected string $titre;

    public function __construct(array $season, int $numberS, string $genre, string $title) {
        $this->episodes = $season;
        $this->nbSaison = $numberS;
        $this->genre = $genre;
        $this->titre = $title;
    }

    public function __get( string $attr) : mixed {
        if (property_exists($this, $attr)) return $this->$attr;
        else {
            throw new Exception("$attr : invalid property");}
    }

}