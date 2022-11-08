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
        $rendererEpisode = new EpisodeRenderer(Episode::getEpisode($_GET['id']));
        return $rendererEpisode->render();
    }
}