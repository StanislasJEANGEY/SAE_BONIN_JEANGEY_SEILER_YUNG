<?php

namespace iutnc\netVOD\action;

class ajouterCommentaireAction extends Action
{
    protected function postExecute(): string {
            $html = <<<EOF
                    <h1 id=Titre>NetVOD</h1>
                    <div id=mainMenu><a id=ButtonCatalogue href=?action=catalogue&trie=note>Catalogue</a>
                    <a id=retour href=?action=signin>Retour à l'accueil</a>
                    <a id=logout href=?action=logout>Se déconnecter</a>
                    </div>
                    <h1 id=Titre>Ajout d’un commentaire</h1>

                    <form action="index.php?action=addComment&idserie={$_GET['idSerie']}" method="POST">
                    <fieldset>
                        <legend>Commentaire : </legend>
                        <input type="text" name="commentaire" id="commentaire">
                        <legend>Note : </legend>
                        <input type="number" name="note" id="note" required max="5" min="1">
                        <input type="hidden" name="idserie" value="{$_GET['idSerie']}">
                        <input type="hidden" name="url" value="{$_SERVER['REQUEST_URI']}">

                        <input id=ButtonCatalogue type="submit" value="Ajouter">
                    </fieldset>
                    </form>
        EOF;
            return $html;


    }




    protected function executeGET(): string {

    }


}
