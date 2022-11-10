<?php

namespace iutnc\netVOD\action;

use iutnc\netVOD\renderer\ProfilRenderer;

class DisplayProfilAction extends Action
{

    protected function postExecute(): string
    {
        if (isset($_SESSION['user'])) {
            $user = unserialize($_SESSION['user']);
            $rendererProfil = new ProfilRenderer($user);
            $user->__set("nom", $_POST['nom']);
            $user->__set("prenom", $_POST['prenom']);
            $user->__set("genrePref", $_POST['genrePref']);
            $user->ajoutBDDInfos();
            $_SESSION['user'] = serialize($user);
            return $rendererProfil->render(2);

        } else return "<a href=?action=signin>Veuillez vous connecter</a>";

    }

    protected function executeGET(): string
    {
        if (isset($_SESSION['user'])) {
            $user = unserialize($_SESSION['user']);
            $rendererProfil = new ProfilRenderer($user);
            if ($user->__get('nom') != '' && $user->__get('prenom') != '' && $user->__get('genrePref') != '') {
                return $rendererProfil->render();
            } else {
                return $rendererProfil->render(2);
            }

        } else return "<a href=?action=signin>Veuillez vous connecter</a>";

    }
}