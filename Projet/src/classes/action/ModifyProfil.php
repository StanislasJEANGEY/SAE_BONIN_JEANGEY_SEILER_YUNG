<?php

namespace iutnc\netVOD\action;

use iutnc\netVOD\renderer\ProfilRenderer;

class ModifyProfil extends Action
{

    protected function executeGET(): string
    {
        if (isset($_SESSION['user'])) {
            $user = unserialize($_SESSION['user']);
            $user->resetUser();
            $rendererProfil = new ProfilRenderer($user);

            return $rendererProfil->render();

        } else return "<a href=?action=signin>Veuillez vous connecter</a>";
    }

    protected function postExecute() : string
    {
        $profil = new DisplayProfilAction();
        $user = unserialize($_SESSION['user']);
        $user->ajoutBDDInfos();
        return $profil->execute();
    }
}