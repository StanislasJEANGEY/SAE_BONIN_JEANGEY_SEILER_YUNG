<?php

namespace iutnc\netVOD\renderer;

use iutnc\netVOD\video\track\Episode;

class EpisodeRenderer implements renderer {
    protected $episode;

    public function __construct(Episode $ep){
        $this->episode = $ep;
    }

    public function render(int $selector = 1): string
    {
        $html = "<h1>Titre : {$this->episode->titre}</h1>";
        foreach ($this->episode->type as $typ){
            $html .= $typ;
        }
        switch ($selector){
            case 1:
                $html =
                    "<h1>Titre : {$this->episode->titre}</h1>" .
                    "<div class = 'resume'>Résumé : {$this->episode->descriptif}</div>  <div class='duree'> 
                        Durée : {$this->episode->duree} min </div><br>".
                    "</div>";
                $html .=  "<div class='track'>" .
                    "<p><video controls src='{$this->episode->source}' type='image/beach.jpg'></video></p>";
                break;
            case 2:
                $html .= <<<END
                        <div class="track">
                        <p><img controls src="{$this->episode->source}" href='?action=ep&id= {$this->episode->id}' ></video></p>                       
                        END;
                break;

        }
        $html .= "<div>Résumé : {$this->episode->resume} Durée : {$this->episode->duree}</p>" . "</div>";
        return $html;
    }


}