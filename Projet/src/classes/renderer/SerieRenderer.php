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
        $html = "<div id=Tout2>";
        $html .= "<div id=MainAfficherSerie>";
        $html .= "<h1 id=titreFav>Série : {$this->serie->titre}</h1>";
        switch ($selector){
            case 1:
                $html .= "
                        <div class='track'>
                        <a href='?action=serie&id=".$this->serie->__get('idSerie')."'> <img id=imgSerie controls src='".$this->serie->image."'width='300' height='300'></img></a>
                        </div>
                        </div>
                        </div>
                        ";

                break;
            case 2:
                $html = "";
                $html = "<h1 id=Titre>NetVOD</h1>";
                $html .= "</div>";
                $html .= "</div>";
                $html .= "<div id=mainMenu>" . "<a id=ButtonCatalogue href=?action=catalogue>Catalogue</a>";
                $html .= "<a id=retour href=?action=signin>Retour à l'accueil</a>";
                $html .= "<a id=logout href=?action=logout>Se déconnecter</a>";
                $html .= "</div>";
                $html .= "<h2>Genre : </h2> {$this->serie->descriptif}<br><br>";
                $bd = ConnectionFactory::makeConnection();
                $requete = $bd->prepare("SELECT * FROM episode WHERE serie_id = ?");
                $requete->bindParam(1, $_GET['id']);
                $requete->execute();

                while ($data = $requete->fetch()){
                    $epRend = new EpisodeRenderer(Episode::getEpisode($data['id']));
                    $html .= $epRend->render(self::LONG);
                }

                $html .= <<<EOF
                            <form method="POST" action="?action=afficherCommentaire&idSerie={$_GET['id']}">
                                <input type="submit" value="Commentaire">
                            </form>
                         EOF;
                break;
        }
        return $html;
    }
}
