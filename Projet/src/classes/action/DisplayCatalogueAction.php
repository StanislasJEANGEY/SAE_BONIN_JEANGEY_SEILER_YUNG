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
        return "<a href=?action=sign-in>Veuillez vous connecter</a>";
    } else {
        $html = "<div id=catTitre><h1 id=Titrecatalogue> Catalogue : </h1> </div>";
        $query = "SELECT idSerie,titre,img FROM serie";
        $result = ConnectionFactory::makeConnection()->prepare($query);
        $result->execute();
        while($data = $result->fetch()){
            $html .= "<div id=MainAfficherSerie>";
            $html .= "<h2>" .$data['titre']. "<h2>";
            $html .= "<a href='?action=serie&id=". $data['idSerie'] . "'><br><img src='". $data['img'] ."' width='300' height='300'></a><br>";
            $html .= "</div>";
        }
    }
    return $html;
    }
}
