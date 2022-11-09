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
} if (!isset($_SESSION['user'])) {
  $htmlRender .= <<<EOF
          <div id="mainReturn">
            <a id="retour" href="index.php">Retour à l'accueil</a>
          </div>
  EOF;
}

echo $htmlRender;
