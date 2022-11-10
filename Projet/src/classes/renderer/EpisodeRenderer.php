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
                $html ="<h1 id=Titre>NetVOD</h1>";
                $html .="<div id=mainMenu>"."<a id=ButtonCatalogue href=?action=catalogue&trie=note>Catalogue</a>";
                $html .="<a id=retour href=?action=signin>Retour à l'accueil</a>";
                $html .="<a id=logout href=?action=logout>Se déconnecter</a>";
                $html .="</div>";
                $html .=
                    "<h1 id=titreFav>Titre : {$this->episode->titre}</h1>" .
                    "<div id=titreFav class = 'resume'>Résumé : {$this->episode->resume}</div>  <div class='duree'>
                        <h1 id=titreFav>Durée : {$this->episode->duree} min </h1></div><br>" .
                    "</div>";
                $html .= "<div class='track'>" .
                    "<p><video controls autoplay id=vd src='video/{$this->episode->source}' type='video/mp4'></video></p>";
                $user = unserialize($_SESSION['user']);
                if (!$user->estCommenter($this->episode->idSerie)){
                    $html .= <<<EOF
                            <form method="POST" action="?action=ajouterCommentaireAction&idSerie={$this->episode->idSerie}">
                                <input id="ButtonCatalogue" type="submit" value="Commenter">
                            </form>
                         EOF;
                } else {
                    $html .= "Série déjà commenter";
                }

                break;

            case 2:
                $bd = ConnectionFactory::makeConnection();
                $requete = $bd->prepare("SELECT img,numero FROM serie inner join episode on serie.idSerie = episode.serie_id WHERE serie.idSerie = ?");
                $requete->bindParam(1, $this->episode->idSerie);
                $requete->execute();
                while ($data = $requete->fetch()) {
                    $html = "<div id=Tout2>";
                    $html .= "<div id=MainAfficherEpisode>";
                    $html .= "<h2 id=titreEpisode>Episode {$this->episode->numero} : {$this->episode->titre}</h2>";
                    $html .= "<p id=titreDuree>Durée :  {$this->episode->duree} secondes</h2>";
                    $html .=
                        "<div class='track'>".
                        "<a href='?action=episode&id={$this->episode->id}&idserie={$this->episode->idSerie}'><br><img id=imgEpisode src='".$data['img']."' width='300' height='300'></a>".
                        "</div>";
                    $html .= "</div>";
                    $html .= "</div>";
                }


                break;

        }
        return $html;
    }


}
