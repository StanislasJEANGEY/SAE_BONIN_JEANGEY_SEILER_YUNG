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

            $nom = filter_var($_POST['nom'], FILTER_SANITIZE_SPECIAL_CHARS);
            $nom = filter_var($nom, FILTER_SANITIZE_STRING);
            $user->__set("nom", $nom);

            $prenom = filter_var($_POST['prenom'], FILTER_SANITIZE_SPECIAL_CHARS);
            $prenom = filter_var($prenom, FILTER_SANITIZE_STRING);
            $user->__set("prenom", $prenom);

            $genre = filter_var($_POST['genrePref'], FILTER_SANITIZE_SPECIAL_CHARS);
            $genre = filter_var($genre, FILTER_SANITIZE_STRING);
            $user->__set("genrePref", $genre);

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