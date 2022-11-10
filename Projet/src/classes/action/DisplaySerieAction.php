<?php

namespace iutnc\netVOD\action;

use iutnc\netVOD\renderer\SerieRenderer;
use iutnc\netVOD\video\list\Serie;

class DisplaySerieAction extends Action {



    protected function executeGET(): string
    {
        $rendererSerie = new SerieRenderer(Serie::getSerie($_GET['id']));
        return $rendererSerie->render(2);
    }

}
