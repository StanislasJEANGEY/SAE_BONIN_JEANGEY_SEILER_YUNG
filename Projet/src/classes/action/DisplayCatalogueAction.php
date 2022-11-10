<?php

namespace iutnc\netVOD\action;
use iutnc\netVOD\db\ConnectionFactory;

class DisplayCatalogueAction extends Action
{
    public function __construct(){
        parent::__construct();
    }


    protected function executeGET(): string
    {
        if(!isset($_SESSION['user'])) {
        return "<a href=?action=signin>Veuillez vous connecter</a>";
    } else {
        $html = "<h1 id=Titre>NetVOD</h1>";
        $html .= "<div id=mainMenu>" . "<a id=ButtonCatalogue href=?action=catalogue>Catalogue</a>";
        $html .= "<a id=retour href=?action=signin>Retour à l'accueil</a>";
        $html .= "<a id=logout href=?action=logout>Se déconnecter</a>";
        $html .= "</div>";
        $html .= "<div id=Tout>";
        $query = "SELECT idSerie,titre,img FROM serie";
        $result = ConnectionFactory::makeConnection()->prepare($query);
        $result->execute();
        while($data = $result->fetch()){
            $html .= "
                  <div id=MainAfficherSerie>
                  <h2>" . $data['titre'] ."<h2>
                  <a href='?action=serie&id=". $data['idSerie'] . "'><br><img src='". $data['img'] ."' width='400' height='225'></a><br>
                  ";

            $user = unserialize($_SESSION['user']);
            if (!$user->EstFavorie($data['idSerie'])){
                $html .= <<<EOF
                <form method="POST" action="?action=favorie&idSerie={$data['idSerie']}">
                    <input type="hidden" name="url" value="{$_SERVER['REQUEST_URI']}">
                    <input type="hidden" name="idserie" value="{$data['idSerie']}">
                    <input type="submit" value="J'adore">
                </form>
                </div>
                EOF;
            } else {
                $html .= <<<EOF
                <form method="POST" action="?action=retirerfavorie&idSerie={$data['idSerie']}">
                    <input type="hidden" name="url" value="{$_SERVER['REQUEST_URI']}">
                    <input type="hidden" name="idserie" value="{$data['idSerie']}">
                    <input type="submit" value="J'aime plus">
                </form>
                </div>
                EOF;
            }


        }
        $html .= "</div>";
    }

    return $html;
    }
}
