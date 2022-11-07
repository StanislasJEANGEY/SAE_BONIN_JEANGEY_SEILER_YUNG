<?php

namespace iutnc\netVOD\action;

use iutnc\netVOD\auth\Auth;
use iutnc\netVOD\Exception\AuthException;

class AddUserAction extends Action
{
    protected function executeGET(): string
    {
        return  <<<EOF
                     <form method="post" action="?action=add-user">
                        <label>Email : <input type ="email" name="email" value='' placeholder='email'> </label> <br>
                        <label>Mot de passe : <input type='password' name='pwd' value=''></label> <br>
                        <label>Ressaisir votre mot de passe : <input type='password' name='pwd2' value=''></label> <br>
                        <button type="submit"> Connexion </button>
                     </form>
                     EOF;
    }

    protected function postExecute(): string
    {
      if(! $_POST['pwd'] === $_POST['pwd2']){
              throw new \iutnc\netVOD\Exception\AuthException("Les saisies de vos mot de passes ne sont pas identiques",5);
          }

        try
        {
            $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
            $mdp = filter_var($_POST['pwd'], FILTER_SANITIZE_SPECIAL_CHARS);

            if (Auth::register($email, $mdp)) {
                $html = "<h2> Inscription réussie </h2>";
            }
        }
        catch (AuthException $e)
        {
            if($e->getCode() == 3){$html = "<h2> Email déjà utilisé </h2>";}
            if($e->getCode() == 4){$html = "<h2> Mot de passe invalide (13 caractères min) </h2>";}
            if($e->getCode() == 5){$html = "<h2> Mot de passe différents </h2>";}
        }
        return $html;
    }
}
