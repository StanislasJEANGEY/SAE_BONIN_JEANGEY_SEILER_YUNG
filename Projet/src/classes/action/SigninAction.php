<?php

namespace iutnc\netVOD\action;

use iutnc\netVOD\auth\Auth;
use iutnc\netVOD\db\ConnectionFactory;
use iutnc\netVOD\Exception\AuthException;
use iutnc\netVOD\renderer\SerieRenderer;
use iutnc\netVOD\video\list\Serie;


class SigninAction extends Action
{

    protected function postExecute(): string
    {
        try {
            $user = Auth::authenticate($_POST['email'], $_POST['password']);
            if (isset($_SESSION['user'])) {
                $html = "<h1 id=Titre>NetVOD</h1>";
                $html .= "<div id=mainMenu>" . "<a id=ButtonCatalogue href=?action=catalogue>Catalogue</a>";
                $html .= "<a id=retour href=?action=signin>Retour à l'accueil</a>";
                $html .= "<a id=logout href=?action=logout>Se déconnecter</a>";
                $html .= "</div>";


                $bd = ConnectionFactory::makeConnection();
                $req = $bd->prepare("SELECT idserie FROM favorite WHERE iduser = ?");

                $iduser = $user->getId();
                $req->bindParam(1, $iduser);
                $req->execute();

                $html .= "<h1> Serie favorites :</h1><br>";
                while ($data = $req->fetch()){
                    $rendererSerie = new SerieRenderer(Serie::getSerie($data['idserie']));
                    $html .= $rendererSerie->render();
                }

            }
        } catch (AuthException $e) {
            $html = "<div id=mainReturnConnexion>";
            $html .= "<h2>" . $e->getMessage() . "</h2>";
            $html .= "<a id=retourConnexion href='?action=signin'>Retour à la connexion</a><br><br>";
            $html .= "</div>";
        }

        return $html;
    }

    protected function executeGET(): string
    {
        if (isset($_SESSION['user'])) {
            $html = "<h1 id=Titre>NetVOD</h1>";
            $html .= "<div id=mainMenu>" . "<a id=ButtonCatalogue href=?action=catalogue>Catalogue</a>";
            $html .= "<a id=retour href=?action=signin>Retour à l'accueil</a>";
            $html .= "<a id=logout href=?action=logout>Se déconnecter</a>";
            $html .= "</div>";

            $user = unserialize($_SESSION['user']);
            $iduser = $user->getId();

            $html .= $this->serieFavorite($iduser);

            $html .= $this->serieEnCours($iduser);

        } else {
            return <<<EOF
                <div id="mainLogin">
                <form method="post">
                    <input id="TextLogin" type="email" placeholder="Email..." name="email">
                    <input id="TextMdp" type="password" placeholder="Mot de passe..." name="password">
                    <input id="ButtonConnexion" type="submit" value="Connexion">
                </form>
                </div>
            EOF;
        }
        return $html;
    }

    public function serieFavorite(string $userid) : string
    {
        $bd = ConnectionFactory::makeConnection();
        $req = $bd->prepare("SELECT idserie FROM favorite WHERE iduser = ?");

        $req->bindParam(1, $userid);
        $req->execute();

        $html = "<h1> Série favorites :</h1><br>";
        while ($data = $req->fetch()){
            $rendererSerie = new SerieRenderer(Serie::getSerie($data['idserie']));
            $html .= $rendererSerie->render();
        }
        return $html;
    }

    public function serieEnCours(string $userid) : string
    {
        $bd = ConnectionFactory::makeConnection();
        $req = $bd->prepare("SELECT idserie FROM current WHERE iduser = ?");
        $req->bindParam(1, $userid);
        $req->execute();

        $html = "<h1> Série en cours :</h1><br>";
        while ($data = $req->fetch()){
            $rendererSerie = new SerieRenderer(Serie::getSerie($data['idserie']));
            $html .= $rendererSerie->render();
        }
        return $html;
    }

}
