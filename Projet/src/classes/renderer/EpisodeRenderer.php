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
        switch ($selector){
            case 1:
                $html =
                    "<h1>Titre : {$this->episode->titre}</h1>" .
                    "<div class = 'resume'>Résumé : {$this->episode->resume}</div>  <div class='duree'> 
                        Durée : {$this->episode->duree} min </div><br>".
                    "</div>";
                $html .=  "<div class='track'>" .
                    "<p><video controls src='video/{$this->episode->source}' type='video/mp4'></video></p>";
                break;
            case 2:
                $html = "<h2>Episode : {$this->episode->titre}</h2>";
                $html .= <<<END
                        <div class="track">
                        <a href='?action=episode&id={$this->episode->id}'><br><img src='image/beach.jpg' width='300' height='300'></a>
                        </div>                    
                        END;
                break;

        }
        return $html;
    }


}