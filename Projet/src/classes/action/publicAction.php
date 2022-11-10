<?php

namespace iutnc\netVOD\action;

class publicAction extends Action
{
    protected function executeGET(): string
    {
        return "erreur =(";
    }

    protected function postExecute(): string {
        $html=DisplayCatalogueAction::boutton();

        switch ($_POST['public']) {
            case 'enfant':
                $query = "SELECT idSerie,titre,img from serie WHERE public = 'enfant'";
                $html .= DisplayCatalogueAction::formulaire($query);
                break;
            case 'ado':
                $query = "SELECT idSerie,titre,img from serie WHERE public = 'ados'";
                $html .= DisplayCatalogueAction::formulaire($query);
                break;
            case 'adulte':
                $query = "SELECT idSerie,titre,img from serie WHERE public = 'adulte'";
                $html .= DisplayCatalogueAction::formulaire($query);
                break;
        }
        return $html;
    }

}