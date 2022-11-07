<?php

namespace iutnc\netVOD\action;

use iutnc\netVOD\auth\Auth;



class SigninAction extends Action
{

    protected function postExecute(): string
    {
        try
        {
            $user = Auth::authenticate($_POST['email'], $_POST['password']);
            //foreach ($user->getPlaylists() as $value)
            //{
            //    return (new AudioListRenderer($value))->render(1);
            //}

        } catch (AuthException $e) {
            if($e->getCode() == 1) {return '<p style="color:red;">Email invalide !</p>';}
            if($e->getCode() == 2) {return '<p style="color:red;">Mot de passe invalide !</p>';}
        }
        return '';
    }

    protected function executeGET(): string
    {
        return <<<EOF
                <form method="post">
                    <input type="email" placeholder="Email" name="email">
                    <input type="password" placeholder="Mot de passe" name="password">
                    <input type="submit" value="Connexion">
                </form>
            EOF;
    }
}
