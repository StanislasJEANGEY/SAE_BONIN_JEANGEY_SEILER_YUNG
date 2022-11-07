<?php

namespace iutnc\netVOD\action;

use iutnc\netVOD\auth\Auth;

class AddUserAction extends Action
{
    protected function executeGET(): string
    {
        return  <<<EOF
                <form method="post">
                    <input type="email" placeholder="Email" name="email">
                    <input type="password" min="11" max="150" placeholder="Password" name="password">
                    <input type="submit" value="Inscription">
                </form>
            EOF;
    }

    protected function postExecute(): string
    {
        $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
        try
        {
            Auth::register($email, $_POST['password']);
            return "Utilisateur inscris =)";
        }
        catch (AuthException $e)
        {
            if($e->getCode() == 3){return "Email déjà utilisé =(";}
            if($e->getCode() == 4){return "Mot de passe invalide (13 caractères min) =O";}
        }
        return "";
    }
}