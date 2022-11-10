<?php

namespace iutnc\netVOD\action;

use iutnc\netVOD\db\ConnectionFactory;

class DisplayCommentaireAction extends Action
{
    protected function postExecute(): string
    {

        if (isset($_SESSION['user'])){
            $user = unserialize($_SESSION['user']);
            $bd = ConnectionFactory::makeConnection();
            $html = "<h3>Commentaire : </h3><p>";
            $requete2 = $bd->prepare('SELECT commentaire, email FROM commentaire 
                                            INNER JOIN Utilisateur ON Utilisateur.id = commentaire.iduser
                                            where idSerie = ?');
            $requete2->bindParam(1,$_GET['idSerie']);
            $requete2->execute();
            while ($data2 = $requete2->fetch()){
                $html .= "L'utilisateur : " . $data2['email'] . " a commenté :" ."<br>";
                $html .= $data2['commentaire'] . "<br>";
            }

            $html .= "</p>";
            return $html ;
        } else {
            return "connecté vous";
        }

    }

    protected function executeGET(): string
    {
        return "erreur =(";
    }

}