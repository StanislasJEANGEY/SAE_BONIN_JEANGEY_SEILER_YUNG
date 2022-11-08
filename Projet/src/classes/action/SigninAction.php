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
<<<<<<< HEAD
            if (isset($user)){
              $html = "<h2>Connexion réussi</h2> <br>"."<a href=?action=catalogue>Catalogue</a>";

}
            //foreach ($user->getPlaylists() as $value)
            //{
            //    return (new AudioListRenderer($value))->render(1);
            //}
=======
            if (isset($user)) $html = "<h2>Connexion réussi</h2>";
>>>>>>> 18c0598e01e1ae002fba47337d18df18fb748ff1

        } catch (AuthException $e) {
            $html = "<h2>".$e->getMessage()."</h2>";
            $html .= "<a href='?action=sign-in'>Retour à la connexion</a><br><br>";

        }

        return $html;
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
