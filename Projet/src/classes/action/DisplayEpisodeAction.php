<?php

namespace iutnc\netVOD\action;

use iutnc\netVOD\renderer\EpisodeRenderer;
use iutnc\netVOD\video\track\Episode;

class DisplayEpisodeAction extends Action
{

    protected function postExecute(): string
    {
        return 'Erreur';
    }

    protected function executeGET(): string
    {
      $serie = $_GET['idserie'];
      if(isset($_SESSION['user'])){
          $user = unserialize($_SESSION['user']);
          if(!$user-> DejaCommencer($serie)){
          $user->AjouterSerieCommencer($serie);
        }
        }
        $rendererEpisode = new EpisodeRenderer(Episode::getEpisode($_GET['id']));
        return $rendererEpisode->render();
    }
}
