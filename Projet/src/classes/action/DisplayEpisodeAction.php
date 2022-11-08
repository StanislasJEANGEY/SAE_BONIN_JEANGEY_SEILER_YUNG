<?php

namespace iutnc\netVOD\action;

use iutnc\netVOD\renderer\EpisodeRenderer;

class DisplayEpisodeAction extends Action
{

    protected function postExecute(): string
    {
        return 'Erreur';
    }

    protected function executeGET(): string
    {
        $rendererEpisode = new EpisodeRenderer();
    }
}