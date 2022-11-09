<?php

namespace iutnc\netVOD\action;
use iutnc\netVOD\db\ConnectionFactory;

class DisplayCatalogueAction extends Action
{
    public function __construct(){
        parent::__construct();
    }

    protected function postExecute(): string
    {
        return "Erreur =(";
    }

    protected function executeGET(): string
    {
        if(!isset($_SESSION['user'])) {
        return "<a href=?action=signin>Veuillez vous connecter</a>";
    } else {
        $html = "<div id=catTitre><h1 id=Titrecatalogue> Catalogue : </h1> </div>";
        $html .= "<div id=Tout>";
        $query = "SELECT idSerie,titre,img FROM serie";
        $result = ConnectionFactory::makeConnection()->prepare($query);
        $result->execute();
        while($data = $result->fetch()){
            $html .= "
                  <div id=MainAfficherSerie>
                  <h2>" . $data['titre'] ."<h2>
                  <a href='?action=serie&id=". $data['idSerie'] . "'><br><img src='". $data['img'] ."' width='300' height='300'></a><br>
                  ";

            $user = unserialize($_SESSION['user']);
            if (!$user->EstFavorie($data['idSerie'])){
                $html .= <<<EOF
                <form method="POST" action="?action=favorie&idSerie={$data['idSerie']}">
                    <input type="hidden" name="url" value="{$_SERVER['REQUEST_URI']}">
                    <input type="hidden" name="idserie" value="{$data['idSerie']}">
                    <input type="submit" value="J'adore =)">
                </form>
                </div>
                EOF;
            } else {
                $html .= "Déja en favorie =0";
            }


        }
        $html .= "</div>";
    }

    return $html;
    }
}
