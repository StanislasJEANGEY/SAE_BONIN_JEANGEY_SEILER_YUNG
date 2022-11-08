<?php

session_start();


require_once 'vendor/autoload.php';


\iutnc\netVOD\db\ConnectionFactory::setConfig();


use iutnc\netVOD\dispatcher\Dispatcher;


$action = isset($_GET['action']) ? $_GET['action'] : null;




if(!isset($playlists))
{
    $playlists = [];
}

$dispatcher = new Dispatcher();
$dispatcher->run();
$htmlRender = '';

if(!isset($_GET['action'])){

$htmlRender = <<<EOF
            <head>
                <link rel="stylesheet" href="index.css">
            </head>
            <ul>
                <li><a id="accueil" href="?action=add-user">Inscription</a></li>
                <li><a id="accueil" href="?action=signin">Connexion</a></li>
            </ul>

EOF;
}else{

  $htmlRender = <<<EOF
          <head>
              <link rel="stylesheet" href="index.css">
          </head>
          <div id="mainReturn">
            <a id="retour" href='index.php'>Retour a l'accueil</a>
            <span>
            <svg width="66px" height="43px" viewBox="0 0 66 43" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
          </div>
  EOF;

}

echo $htmlRender;
