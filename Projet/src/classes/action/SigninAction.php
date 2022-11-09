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
                $html = "<h1 id=Titre>NetVOD</h1>";
                $html .= "<div id=mainMenu>" . "<a id=ButtonCatalogue href=?action=catalogue>Catalogue</a>";
                $html .= "<a id=retour href=?action=signin>Retour à l'accueil</a>";
                $html .= "<a id=logout href=?action=logout>Se déconnecter</a>";
                $html .= "</div>";
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
          $html = "<h1 id=Titre>NetVOD</h1>";
          $html .= "<div id=mainMenu>" . "<a id=ButtonCatalogue href=?action=catalogue>Catalogue</a>";
          $html .= "<a id=retour href=?action=signin>Retour à l'accueil</a>";
          $html .= "<a id=logout href=?action=logout>Se déconnecter</a>";
          $html .= "</div>";
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
