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

$htmlRender = <<<EOF
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Deefy</title>
    </head>
    <body>
    <nav>
        <ul>
            <li><a href="?action=add-user">Inscription</a></li>
            <li><a href="?action=signin">Connexion</a></li>
            <li><a href="?action=add-playlist">Ajouter une Playlist</a></li>
            <li><a href="?action=display-playlist">Afficher une Playlist</a></li>
        </ul>
    </nav>

EOF;

$dispatcher = new Dispatcher($action);
$dispatcher->renderPage($htmlRender);

