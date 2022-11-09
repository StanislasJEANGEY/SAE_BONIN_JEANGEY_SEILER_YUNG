<?php

namespace iutnc\netVOD\renderer;

use iutnc\netVOD\db\ConnectionFactory;
use iutnc\netVOD\video\track\Episode;

class EpisodeRenderer implements renderer
{
    protected $episode;

    public function __construct(Episode $ep)
    {
        $this->episode = $ep;
    }

    public function render(int $selector = 1): string
    {
        switch ($selector) {
            case 1:
                $html =
                    "<h1>Titre : {$this->episode->titre}</h1>" .
                    "<div class = 'resume'>Résumé : {$this->episode->resume}</div>  <div class='duree'>
                        Durée : {$this->episode->duree} min </div><br>" .
                    "</div>";
                $html .= "<div class='track'>" .
                    "<p><video controls src='video/{$this->episode->source}' type='video/mp4'></video></p>";
                break;
            case 2:
                $bd = ConnectionFactory::makeConnection();
                $requete = $bd->prepare("SELECT img,numero FROM serie inner join episode on serie.idSerie = episode.serie_id WHERE serie.idSerie = ?");
                $requete->bindParam(1, $this->episode->idSerie);
                $requete->execute();
                while ($data = $requete->fetch()) {
                    $html = "<h2>Episode {$this->episode->numero} : {$this->episode->titre}</h2>";
                    $html .= "<p>Durée :  {$this->episode->duree}</h2>";
                    $html .=
                        "<div class='track'>".
                        "<a href='?action=episode&id={$this->episode->id}'><br><img src='".$data['img']."' width='300' height='300'></a>".
                        "</div>";
                }
                break;

        }
        return $html;
    }


}
