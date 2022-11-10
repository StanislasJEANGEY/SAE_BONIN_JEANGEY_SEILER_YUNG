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
                                <input type="hidden" name="url" value="{$_SERVER['REQUEST_URI']}">
                                <input type="submit" value="Commentaire">
                            </form>
                         EOF;

                /**
                $html .= "<h3>Commentaire : </h3>";
                $requete2 = $bd->prepare('SELECT commentaire FROM commentaire where idSerie = ?');
                while ($data2 = $requete2->fetch()){
                    $html .= $data['commentaire'];
                }
                $requete3 = $bd->prepare('SELECT MOY(note) as moy FROM commentaire where idSerie = ?');
                $html .= "<p>Note moyenne : </p>";
                while ($data3 = $requete3->fetch()){
                    $html.= $data['moy'];
                }
                 */
                break;
        }
        return $html;
    }
}
