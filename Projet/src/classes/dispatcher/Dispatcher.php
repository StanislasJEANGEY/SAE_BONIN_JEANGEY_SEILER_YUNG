<?php

namespace iutnc\netVOD\dispatcher;


use iutnc\netVOD\action\DisplayEpisodeAction;
use iutnc\netVOD\action\SigninAction;
use iutnc\netVOD\action\AddUserAction;
use iutnc\netVOD\action\DisplayCatalogueAction;
use iutnc\netVOD\action\DisplaySerieAction;

class Dispatcher
{

    protected ?string $action = null;

    public function __construct()
    {
        $this->action = isset($_GET['action']) ? $_GET['action'] : null;
    }


    public function run(): void
    {
        $action = null;

        switch ($this->action) {
            case("add-user"):
                $action = new AddUserAction();
                $html = $action->execute();
                break;
            case("add-playlist"):
                $action = new AddPlaylistAction();
                $html = $action->execute();
                break;
            case("signin"):
                $action = new SigninAction();
                $html = $action->execute();
                break;
            case("catalogue"):
                $action = new DisplayCatalogueAction();
                $html = $action->execute();
                break;
            case ("episode"):
                $action = new DisplayEpisodeAction();
                $html = $action->execute();
                break;
            case("serie"):
            $action = new DisplaySerieAction();
            $html = $action->execute();
            break;
            default:
                $html = "<h1>Acceuil</h1>";
                break;
        }
        $this->renderPage($html);
    }


    public function renderPage(string $html): void
    {
        echo <<<end
            <!DOCTYPE html>
            <html lang="fr">
            <head>
                <title>NetVOD</title>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
            </head>
            <body>
            $html
            </body>
        end;

    }

}
