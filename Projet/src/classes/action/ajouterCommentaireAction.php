<?php

namespace iutnc\netVOD\action;

class ajouterCommentaireAction extends Action
{
    protected function postExecute(): string {
            $html = <<<EOF
                    <h1>Ajout d’un commentaire</h1>

                    <form action="index.php?action=addComment&idserie={$_GET['idSerie']}" method="POST">
                    <fieldset>
                        <legend>Commentaire : </legend>
                        <input type="text" name="commentaire" id="commentaire">
                        <legend>Note : </legend>
                        <input type="number" name="note" id="note" required max="5" min="1">
                        <input type="hidden" name="idserie" value="{$_GET['idSerie']}">
                        <input type="hidden" name="url" value="{$_SERVER['REQUEST_URI']}">
        
                        <input type="submit" value="Ajouter">
                    </fieldset>
                    </form>
        EOF;
            return $html;


    }




    protected function executeGET(): string {

    }


}
