<?php

session_start();


require_once 'vendor/autoload.php';


\iutnc\netVOD\db\ConnectionFactory::setConfig();


use iutnc\netVOD\dispatcher\Dispatcher;


$action = isset($_GET['action']) ? $_GET['action'] : null;




if (!isset($playlists)) {
  $playlists = [];
}

$dispatcher = new Dispatcher();
$dispatcher->run();
$htmlRender = '<head>
              <link rel="stylesheet" href="index.css">
              </head>';


if (!isset($_GET['action'])) {

  $htmlRender .= <<<EOF
            <ul>
                <li><a id="accueil" href="?action=add-user">Inscription</a></li>
                <li><a id="accueil" href="?action=signin">Connexion</a></li>
            </ul>

EOF;
} else {

<<<<<<< HEAD
  $htmlRender .= <<<EOF
          <div id="mainReturn">
            <a id="retour" href="?action=signin">Retour à l'accueil</a>
            <span>
            <svg width="66px" height="43px" viewBox="0 0 66 43" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
          </div>
  EOF;
=======
  if(isset($_GET['action']) == 'catalogue'){
    $htmlRender .= <<<EOF
            <div id="mainReturn">
              <a id="retour" href='?action=accueil'>Retour en arrière</a>
              <span>
              <svg width="66px" height="43px" viewBox="0 0 66 43" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
            </div>
        EOF;
  }else{

      $htmlRender .= <<<EOF
              <div id="mainReturn">
                <a id="retour" href='index.php'>Retour à l'accueil</a>
                <span>
                <svg width="66px" height="43px" viewBox="0 0 66 43" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
              </div>
      EOF;
    }
>>>>>>> b74d1982d62740ec4602e2fa6cc659fc2a9b1b86
}

echo $htmlRender;
