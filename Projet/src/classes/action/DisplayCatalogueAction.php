<?php

namespace iutnc\netVOD\action;
use iutnc\netVOD\db\ConnectionFactory;
use iutnc\netVOD\video\list\Serie;
use iutnc\netVOD\renderer\renderer;
use iutnc\netVOD\renderer\SerieRenderer;

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
        $user = unserialize($_SESSION['user']);
        $html = "<h1> Catalogue : </h1>";
        $query = "SELECT id,titre,img FROM serie";
        $result = ConnectionFactory::makeConnection()->prepare($query);
        $result->execute();
        while($data = $result->fetch()){
            $html .= $data['titre'];
            $html .= "<a href='?action=display-catalogue&titre=' ". $data['id'] . "><br><img src='image/beach.jpg' width='300' height='300'></a><br>";
        }
    }
    return $html;
    }
}
