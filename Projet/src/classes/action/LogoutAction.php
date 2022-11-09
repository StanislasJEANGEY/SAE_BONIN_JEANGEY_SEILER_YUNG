<?php

namespace iutnc\netVOD\action;

use iutnc\netVOD\auth\Auth;

class LogoutAction extends Action
{

    protected function postExecute(): string
    {
        return 'Erreur';
    }

    protected function executeGET(): string
    {
        if (isset($_SESSION['user'])) {
            Auth::logout();
            $html = "<center><h1>Déconnecté</h1></center>";
        } else $html = '';
        return $html;    }
}