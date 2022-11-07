<?php

namespace iutnc\deefy\dispatcher;

use iutnc\deefy\action\AddPlaylistAction;
use iutnc\deefy\action\AddPodcastTrackAction;
use iutnc\deefy\action\AddUserAction;
use iutnc\deefy\action\DisplayPlaylistAction;
use iutnc\deefy\action\SigninAction;

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