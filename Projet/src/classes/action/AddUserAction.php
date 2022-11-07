<?php

namespace iutnc\netVOD\action;

use iutnc\netVOD\auth\Auth;

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
              throw new \iutnc\netVOD\Exception\AuthException("Les saisies de vos mot de passes ne sont pas identiques");
          }
        try
        {
            $email = filter_var($_POST['email'], FILTER_VALIDATE_EMAIL);
            $mdp = filter_var($_POST['pwd'], FILTER_SANITIZE_SPECIAL_CHARS);

            if (Auth::register($email, $mdp)) {
                $html = "Inscription réussie";
            }
        }
        catch (AuthException $e)
        {
            if($e->getCode() == 3){return "Email déjà utilisé =(";}
            if($e->getCode() == 4){return "Mot de passe invalide (13 caractères min) =O";}
        }
        return "";
    }
}
