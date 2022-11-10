<?php

namespace iutnc\netVOD\dispatcher;


use iutnc\netVOD\action\addCommentAction;
use iutnc\netVOD\action\ajouterCommentaireAction;
use iutnc\netVOD\action\DisplayCommentaireAction;
use iutnc\netVOD\action\DisplayEpisodeAction;
use iutnc\netVOD\action\DisplayProfilAction;
use iutnc\netVOD\action\FavorieAction;
use iutnc\netVOD\action\genreAction;
use iutnc\netVOD\action\LogoutAction;
use iutnc\netVOD\action\ModifyProfil;
use iutnc\netVOD\action\publicAction;
use iutnc\netVOD\action\RetirerFavorieAction;
use iutnc\netVOD\action\SigninAction;
use iutnc\netVOD\action\AddUserAction;
use iutnc\netVOD\action\DisplayCatalogueAction;
use iutnc\netVOD\action\DisplaySerieAction;
use iutnc\netVOD\action\TrieAction;


class Dispatcher
{

    protected ?string $action = null;

    public function __construct()
    {
        $this->action = isset($_GET['action']) ? $_GET['action'] : null;
    }


    public function run(): void
    {
        $html="";
        switch ($this->action) {

            case("add-user"):
                $action = new AddUserAction();
                $html = $action->execute();
                break;
            case("signin"):
                $action = new SigninAction();
                $html = $action->execute();
                break;
            case ("trie"):
                $action = new TrieAction();
                $html = $action->execute();
                break;
            case ("genre"):
                $action = new genreAction();
                $html = $action->execute();
                break;
            case ("public"):
                $action = new publicAction();
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
            case("logout"):
                $action = new LogoutAction();
                $html = $action->execute();
                break;
            case ("favorie"):
                $action = new FavorieAction();
                $html .= $action->execute();
                break;
            case ("profil"):
                $action = new DisplayProfilAction();
                $html .= $action->execute();
                break;
            case 'retirerfavorie':
                $action = new RetirerFavorieAction();
                $html .= $action->execute();
                break;
            case 'addComment':
                $action = new addCommentAction();
                $html .= $action->execute();
                break;
            case 'ajouterCommentaireAction':
                $action = new ajouterCommentaireAction();
                $html .= $action->execute();
                break;
            case 'afficherCommentaire':
                $action = new DisplayCommentaireAction();
                $html .= $action->execute();
                break;
            case 'modifyProfil' :
                $action = new ModifyProfil();
                $html .= $action->execute();
                break;
            default:
                $html = "<h1 id=Titre>NetVOD</h1>";
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
