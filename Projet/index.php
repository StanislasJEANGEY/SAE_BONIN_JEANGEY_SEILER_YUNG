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

        <ul>
            <li><a href="?action=add-user">Inscription</a></li>
            <li><a href="?action=signin">Connexion</a></li>
        </ul>
EOF;
}else{
  $htmlRender = <<<EOF

          <a href='index.php'>Retour a l'accueil</a>;
  EOF;
}
echo $htmlRender;
