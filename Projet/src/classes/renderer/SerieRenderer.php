<?php

namespace iutnc\netVOD\renderer;
use iutnc\netVOD\renderer\EpisodeRenderer;
use iutnc\netVOD\video\list\Serie;

class SerieRenderer implements renderer {
    protected $serie;

    public function __construct(Serie $ser){
        $this->serie = $ser;
    }

    public function render(int $selector = 1): string
    {
        $html = "<h1>Titre : {$this->serie->titre}</h1>";
        switch ($selector){
            case 1:
                $html .= <<<END
                        <div class="track">
                        <p><img controls src="{$this->episode->image}></img></p>"
                        END;

                break;
            case 2:
                $html .= "Genre : {$this->serie->descriptif}";
                foreach ($this->serie->__get('episodes') as $ep){
                    $epRend = new EpisodeRenderer($ep);
                    $html .= $epRend->render(self::LONG);
                }
                break;
        }
        return $html;
    }
}