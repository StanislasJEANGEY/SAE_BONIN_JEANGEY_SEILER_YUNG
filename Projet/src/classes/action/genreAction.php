<?php

namespace iutnc\netVOD\action;

class genreAction extends Action
{
    protected function executeGET(): string
    {
        return "erreur";
    }

    protected function postExecute(): string {
        $html=DisplayCatalogueAction::boutton();

        switch ($_POST['genre']) {
            case 'Comedie':
                $query = "SELECT idSerie,titre,img from serie WHERE genre = 'Comedie'";
                $html .= DisplayCatalogueAction::formulaire($query);
                break;
            case 'Action':
                $query = "SELECT idSerie,titre,img from serie WHERE genre = 'Action'";
                $html .= DisplayCatalogueAction::formulaire($query);
                break;
            case 'Horreur':
                $query = "SELECT idSerie,titre,img from serie WHERE genre = 'Horreur'";
                $html .= DisplayCatalogueAction::formulaire($query);
                break;
            case 'Drame':
                $query = "SELECT idSerie,titre,img from serie WHERE genre = 'Drame'";
                $html .= DisplayCatalogueAction::formulaire($query);
                break;
            case 'Aventure':
                $query = "SELECT idSerie,titre,img from serie WHERE genre = 'Aventure'";
                $html .= DisplayCatalogueAction::formulaire($query);
                break;
        }
        return $html;
    }

}