<?php

namespace iutnc\netVOD\renderer;

use iutnc\netVOD\render\renderer;
use iutnc\netVOD\video\track\Episode;

class EpisodeRenderer implements renderer {
    protected $episode;

    public function __construct(Episode $ep){
        $this->episode = $ep;
    }

    public function render(int $selector = 1): string
    {
        $html = "<h1>Titre : {$this->episode->titre}</h1>" . implode(' ', $this->episode->genre);
        foreach ($this->episode->type as $typ){
            $html .= $typ;
        }
        switch ($selector){
            case 1:
                $html .= <<<END
                        <div class="track">
                        <p><img controls src="{$this->episode->source}></img></p>"
                        END;
                break;
            case 2:
                $html .= <<<END
                        <div class="track">
                        <p><video controls src="{$this->episode->source}></video></p>"                        
                        END;
                break;

        }
        $html .= "<div>Résumé : {$this->episode->resume} Durée : {$this->episode->duree}</p>" . "</div>";
        return $html;
    }
}