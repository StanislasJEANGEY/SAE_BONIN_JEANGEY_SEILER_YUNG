<?php

namespace iutnc\netVOD\action;

class ajouterCommentaireAction extends Action
{
    protected function postExecute(): string
    {
        $html = <<<EOF
        <h1>Ajout d’un commentaire</h1>

        <form action="index.php?action=ajouterCommentaireAction" method="post">
        <fieldset>
        <legend>Commentaire : </legend>
        <input type="text" name="commentaire" id="commentaire">
        <legend>Commentaire : </legend>
        <input type="number" name="note" id="note" required>
        <input type="hidden" name="id" value="{$_GET['id']}">
        <input type="submit" value="Ajouter">
        </fieldset>
        </form>
        EOF;
        return $html;
    }

    protected function executeGET(): string
    {
        {
            if ($_POST['note'] != null) {
                $commentaire = $_POST['commentaire'];
                $note = $_POST['note'];
                $idserie = $_POST['id'];
                try {
                    $user = unserialize($_SESSION['user']);
                    $iduser = $user->__get('id');
                    $user->ajouterCommentaire($idserie,$iduser,$note,$commentaire);
                } catch (\Exception $e){
                    echo $e->getMessage();
                }
                die();
            } else {
                return '<h1>Ils sont noter</h1>';
            }
        }
    }


}
