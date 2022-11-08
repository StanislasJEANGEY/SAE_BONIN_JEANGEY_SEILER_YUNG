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
$html = '';
      if(!isset($_SESSION['user'])) {
     return "<a href=?action=sign-in>Veuillez vous connecter</a>";
 } else {
     $user = unserialize($_SESSION['user']);
     $query = "SELECT id,titre,img,descriptif,annee FROM serie";
     $result = ConnectionFactory::makeConnection()->prepare($query);
     $result->execute();
     while($data = $result->fetch()){
        $titre = $data['titre'];

        $render->renderer();
        $html .= $titre.'<br>';
     }
   }
return $html;
}
    }
