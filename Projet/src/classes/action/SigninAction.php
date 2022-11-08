<?php

namespace iutnc\netVOD\action;

use iutnc\netVOD\auth\Auth;
use iutnc\netVOD\Exception\AuthException;



class SigninAction extends Action
{

    protected function postExecute(): string
    {
        try
        {
            $user = Auth::authenticate($_POST['email'], $_POST['password']);
            if (isset($user)){
              $html = "<h2>Connexion réussi</h2> <br>"."<a href=?action=catalogue>Catalogue</a>";
}
        } catch (AuthException $e) {
            $html = "<h2>".$e->getMessage()."</h2>";
            $html .= "<a href='?action=signin'>Retour à la connexion</a><br><br>";

        }

        return $html;
    }

    protected function executeGET(): string
    {
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
}
