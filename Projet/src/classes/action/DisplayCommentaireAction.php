<?php

namespace iutnc\netVOD\action;

use iutnc\netVOD\db\ConnectionFactory;

class DisplayCommentaireAction extends Action
{
    protected function postExecute(): string
    {
        $bd = ConnectionFactory::makeConnection();
        $html = "<h3>Commentaire : </h3>";
        $requete2 = $bd->prepare('SELECT commentaire FROM commentaire where idSerie = ?');
        while ($data2 = $requete2->fetch()){
            $html .= $data2['commentaire'];
        }
        $requete3 = $bd->prepare('SELECT MOY(note) as moy FROM commentaire where idSerie = ?');
        $html .= "<p>Note moyenne : </p>";
        while ($data3 = $requete3->fetch()) {
            $html .= $data3['moy'];
        }
        return $html;
    }

    protected function executeGET(): string
    {
        return "erreur =(";
    }

}