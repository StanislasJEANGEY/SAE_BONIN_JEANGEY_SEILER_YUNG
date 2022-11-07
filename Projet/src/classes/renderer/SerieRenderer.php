<?php

namespace iutnc\netVOD\renderer;
use iutnc\netVOD\renderer\EpisodeRenderer;

class SerieRenderer implements renderer {
    protected $serie;

    public function render(int $selector): string
    {
        $html = "<h1>Titre : {$this->serie->titre}</h1>";
        switch ($selector){
            case 1:

                foreach ($this->serie->__get('episodes') as $ep){
                    $epRend = new EpisodeRenderer($ep);
                    $html .= $epRend->render(self::COMPACT);
                }
                break;
            case 2:
                $html .= "Genre : {$this->serie->genre}";
                foreach ($this->serie->__get('episodes') as $ep){
                    $epRend = new EpisodeRenderer($ep);
                    $html .= $epRend->render(self::LONG);
                }
                break;
        }
        return $html;
    }
}