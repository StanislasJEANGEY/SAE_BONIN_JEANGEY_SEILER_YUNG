<?php

namespace iutnc\netVOD\action;
use iutnc\netVOD\db\ConnectionFactory;

class AccueilAction extends Action
{

    protected function postExecute(): string
    {
        return "Erreur =(";
    }

    protected function executeGET(): string
    {
      try
      {
          $user = Auth::authenticate($_POST['email'], $_POST['password']);
          if (isset($user)){
            $html = "<div id=MainButtonCatalogue>" .  "<a id=ButtonCatalogue href=?action=catalogue>Catalogue</a>";
          }
      } catch (AuthException $e) {
          $html = "<h2>".$e->getMessage()."</h2>";
          $html .= "<a href='?action=signin'>Retour à la connexion</a><br><br>";

      }

      return $html;
  }
}
