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
            $idserie = $_POST['idserie'];
            $commentaire = $_POST['commentaire'];
            $note = $_POST['note'];
            $user->ajouterCommentaire($idserie,  $commentaire, $note);
            header('Location: index.php?action=serie&id=' . $_POST['idserie']);
            die();
        } else {
            return "Connecté vous";
        }
    }


}
