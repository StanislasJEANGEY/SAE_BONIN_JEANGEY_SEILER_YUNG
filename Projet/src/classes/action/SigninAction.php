<?php

namespace iutnc\netVOD\action;

use iutnc\netVOD\auth\Auth;
use iutnc\netVOD\Exception\AuthException;


class SigninAction extends Action
{

    protected function postExecute(): string
    {
        try {
            $user = Auth::authenticate($_POST['email'], $_POST['password']);
            if (isset($_SESSION['user'])) {
                $html = "<div id=mainReturn>" . "<a id=ButtonCatalogue href=?action=catalogue>Catalogue</a>" . "</div>";
            }
        } catch (AuthException $e) {
            $html = "<div id=mainReturnConnexion>";
            $html .= "<h2>" . $e->getMessage() . "</h2>";
            $html .= "<a id=retourConnexion href='?action=signin'>Retour à la connexion</a><br><br>";
            $html .= "</div>";
        }

        return $html;
    }

    protected function executeGET(): string
    {
        if (isset($_SESSION['user'])) {
            $html = "<div id=MainButtonCatalogue>" . "<a id=ButtonCatalogue href=?action=catalogue>Catalogue</a>";
        } else {
            return <<<EOF
                <div id="mainLogin">
                <form method="post">
                    <input id="TextLogin" type="email" placeholder="Email..." name="email">
                    <input id="TextMdp" type="password" placeholder="Mot de passe..." name="password">
                    <input id="ButtonConnexion" type="submit" value="Connexion">
                </form>
                </div>
            EOF;
        }
        return $html;
    }

}
