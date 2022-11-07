<?php

namespace iutnc\netVOD\dispatcher;


use iutnc\netVOD\action\SigninAction;
use iutnc\netVOD\action\AddUserAction;

class Dispatcher
{

    private ?string $action;

    public function __construct(?string $action)
    {
        $this->action = $action;
    }

    public function run() : string
    {
        $action = null;

        switch ($this->action)
        {
            case("add-user"):
                $action = new AddUserAction();
                break;
            case("add-playlist"):
                $action = new AddPlaylistAction();
                break;
            case("add-podcasttrack"):
                $action = new AddPodcastTrackAction();
                break;
            case("signin"):
                $action = new SigninAction();
                break;
            case("display-playlist"):
                $action = new DisplayPlaylistAction();
                break;
            default:
                return "<h1>Bienvenue</h1>";

        }
        return $action->execute();
    }

    public function renderPage(string $html) : void
    {
        echo $html . $this->run() . <<<EOF
        </body>
        </html>
        EOF;
    }

}
