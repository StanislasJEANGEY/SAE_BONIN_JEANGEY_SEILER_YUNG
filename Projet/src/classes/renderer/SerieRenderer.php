<?php

namespace iutnc\netVOD\renderer;
use iutnc\netVOD\db\ConnectionFactory;
use iutnc\netVOD\video\list\Serie;
use iutnc\netVOD\video\track\Episode;

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
                        1
                        <div class="track">
                        <p><img controls src="{$this->episode->image}></img></p>"
                        END;

                break;
            case 2:
                $html .= "Genre : {$this->serie->descriptif}";
                $bd = ConnectionFactory::makeConnection();
                $requete = $bd->prepare("SELECT * FROM episode WHERE serie_id = ?");
                $requete->bindParam(1, $_GET['id']);
                $requete->execute();
                while ($data = $requete->fetch()){
                    $epRend = new EpisodeRenderer(Episode::getEpisode($data['id']));
                    $html .= $epRend->render(self::LONG);
                }
                break;
        }
        return $html;
    }
}