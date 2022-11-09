<?php

namespace iutnc\netVOD\action;

use iutnc\netVOD\user\User;

class FavorieAction extends Action {
    protected function postExecute(): string
    {
        $serie = $_GET['idSerie'];
        if(isset($_SESSION['user'])){
            $user = unserialize($_SESSION['user']);
            $user->ajoutSerieFav($serie);
        }
        $html = 'localhost' . $_POST['url'];
        echo $html;
        header('Location: index.php?action=catalogue');
        die();
    }

    protected function executeGET(): string
    {
        return "erreur =(";

    }



}