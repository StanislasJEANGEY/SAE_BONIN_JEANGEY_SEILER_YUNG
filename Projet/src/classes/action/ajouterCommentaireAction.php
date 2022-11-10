<?php

namespace iutnc\netVOD\action;

class ajouterCommentaireAction extends Action
{
    protected function postExecute(): string
    {
        $html = <<<EOF
        <h1>Ajout d’un commentaire</h1>

        <form action="index.php?action=ajouterCommentaireAction" method="GET">
        <fieldset>
        <legend>Commentaire : </legend>
        <input type="text" name="commentaire" id="commentaire">
        <legend>Note : </legend>
        <input type="number" name="note" id="note" required>
        <input type="hidden" name="idserie" value="{$_GET['idSerie']}">
        <input type="submit" value="Ajouter">
        </fieldset>
        </form>
        EOF;

        return $html;
    }

    protected function executeGET(): string {
        $user = unserialize($_SESSION['user']);
        $idserie = $_GET['idserie'];

        $commentaire = $_GET['commentaire'];
        $note = $_GET['note'];

        try {

            $iduser = $user->__get('id');
            $user->ajouterCommentaire($idserie, $iduser, $note, $commentaire);

        } catch (\Exception $e) {
            echo $e->getMessage();
        }
        echo $_GET['URL'];
        header('Location: index.php?action=catalogue');
        die();
    }


}
