<?php

namespace iutnc\netVOD\action;

class addCommentAction extends Action
{
    private int $note;
    protected function executeGET(): string
    {
        return "erreur =(";
    }

    protected function postExecute(): string {
        if(isset($_SESSION['user'])) {
            $user = unserialize($_SESSION['user']);
            $idserie = $_GET['idserie'];
            $commentaire = $_GET['commentaire'];
            $note = $_GET['note'];
            $iduser = $user->__get('id');
            $user->ajouterCommentaire($idserie, $note, $commentaire);
            echo $_GET['url'];
            header('Location:');
            die();
        } else {
            return "Connecté vous";
        }
    }


}