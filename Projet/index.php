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
                <li><a href="?action=add-user">Inscription</a></li>
                <li><a href="?action=signin">Connexion</a></li>
            </ul>


EOF;
}else{
  if($_GET['action']=='signin'){
    $htmlRender = <<<EOF
            <a href="?action=catalogue">Catalogue</a>
            <a href='index.php'>Retour a l'accueil</a>
    EOF;
  }else{
  $htmlRender = <<<EOF
          <head>
              <link rel="stylesheet" href="index.css">
          </head>
          <a id="retour" href='index.php'>Retour a l'accueil</a>

  EOF;

}
}
echo $htmlRender;
