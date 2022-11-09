<?php

namespace iutnc\netVOD\action;

use iutnc\netVOD\renderer\ProfilRenderer;

class DisplayProfilAction extends Action
{

    protected function postExecute(): string
    {
        return 'Erreur';
    }

    protected function executeGET(): string
    {
        if (isset($_SESSION['user'])) {
            $rendererProfil = new ProfilRenderer(unserialize($_SESSION['user']));
            return $rendererProfil->render();
        } else return 'Erreur';
    }
}