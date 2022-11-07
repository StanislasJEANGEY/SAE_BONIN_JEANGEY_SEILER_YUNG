<?php

namespace iutnc\netVOD\action;

class DisplayCatalogueAction extends Action
{
    public function __construct(){
        parent::__construct();
    }

    protected function postExecute(): string
    {
        return "Erreur =(";
    }

    protected function executeGET(): string
    {
        // TODO: Implement executeGET() method.
    }
}