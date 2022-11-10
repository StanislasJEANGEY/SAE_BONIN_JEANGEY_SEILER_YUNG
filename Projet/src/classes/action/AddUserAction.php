<?php

namespace iutnc\netVOD\action;

use iutnc\netVOD\auth\Auth;
use iutnc\netVOD\Exception\AuthException;

class AddUserAction extends Action
{
    protected function executeGET(): string
    {
        return <<<EOF
                     <div id="MainRegister">
                     <form method="post" action="?action=add-user">
                        <span id="espace"><label id="labelRegister">Email : </label><br><input id="TextLogin" type ="email" name="email" value='' placeholder='Saisir email...'><br></span>
                        <span id="espace"><label id="labelRegister">Mot de passe : </label><br><input id="TextMdp" type='password' name='pwd' placeholder='Mot de passe...' value=''><br></span>
                        <span id="espace"><label id="labelRegister">Confirmer votre mot de passe : </label><br><input id="TextMdp" type='password' name='pwd2' placeholder='Mot de passe...' value=''><br></span>
                        <button id="ButtonConnexion" type="submit"> Inscription </button>
                     </form>
                     </div>
                     EOF;
    }

    protected function postExecute(): string
    {
        try {
            if ($_POST['pwd'] === $_POST['pwd2']) {
                $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
                $mdp = filter_var($_POST['pwd'], FILTER_SANITIZE_SPECIAL_CHARS);

                if (Auth::register($email, $mdp)) {
                    $html = "<center><h2> Inscription réussie </h2></center>";
                }
            } else
                throw new AuthException("Les saisies de vos mot de passes ne sont pas identiques");

        } catch (AuthException $e) {
            $html = "<div id=mainReturnRegister>";
            $html .= "<h2> ".$e->getMessage()." </h2>";
            $html .= "<a id=retourRegister href='?action=add-user'>Retour à l'inscription</a></div><br><br>";
            $html .= "</div>";
        }
        return $html;
    }
}
