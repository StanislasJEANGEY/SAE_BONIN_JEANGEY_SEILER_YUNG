<?php

namespace iutnc\netVOD\action;

class TrieAction extends Action
{
    protected function executeGET(): string
    {
        return 1;
    }

    protected function postExecute(): string{

        header('Location: index.php?action=catalogue');
        die();
    }

}