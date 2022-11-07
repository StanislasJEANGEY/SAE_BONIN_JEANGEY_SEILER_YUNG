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
        $html = "";

        switch ($selector){
            case 1:
                $html .= <<<END
                        <div class="track">
                        <p><img controls src="{$this->episode->image}></img></p>"
                        END;
                break;
            case 2:
                $html .= <<<END
                        <div class="track">
                        <p><video controls src="{$this->episode->video}></video></p>"                        
                        END;
                break;

        }
        return $html;
    }
}