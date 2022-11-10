<?php

namespace iutnc\netVOD\action;

use iutnc\netVOD\renderer\EpisodeRenderer;
use iutnc\netVOD\video\track\Episode;

class DisplayEpisodeAction extends Action
{

    protected function executeGET(): string
    {
        $serie = $_GET['idserie'];
        $id = $_GET['id'];
        if (isset($_SESSION['user'])) {
            $user = unserialize($_SESSION['user']);
            if(!$user->Finir($serie)){

                $user->AjouterSerieCommencer($serie,$id);
              }else{
                $user->ajouterSerieFini($serie);
              }
        }

        $rendererEpisode = new EpisodeRenderer(Episode::getEpisode($_GET['id']));
        return $rendererEpisode->render();
    }
}
