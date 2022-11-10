<?php

namespace iutnc\netVOD\action;

use iutnc\netVOD\db\ConnectionFactory;
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
            $bd = ConnectionFactory::makeConnection();
            $query = $bd->prepare("SELECT nom, prenom, genrePref FROM Utilisateur WHERE id = ?");
            $id = $user->__get('id');
            $query->bindParam(1,$id);
            $query->execute();
            $data = $query->fetchAll();
            if ( $data[0]['nom'] == null && $data[0]['prenom'] == null && $data[0]['genrePref'] == null)            {
                return $rendererProfil->render();
            } else {
                return $rendererProfil->render(2);
            }

        } else return "<a href=?action=signin>Veuillez vous connecter</a>";

    }
}