<?php

namespace iutnc\deefy\model;

use iutnc\deefy\audio\lists\Playlist;
use iutnc\deefy\db\ConnectionFactory;

class User 
{
    private String $user;
    private String $passwd;
    private int $role;


    public function __construct(string $user, string $passwd, int $role)
    {
        $this->user = $user;
        $this->passwd = $passwd;
        $this->role = $role;
    }

    public function getRole() : int
    {
        return $this->role;
    }

    public function getEmail() : string
    {
        return $this->user;
    }

    public function getPlaylists() : array
    {
        $bd = ConnectionFactory::makeConnection();
        $state = $bd->prepare("SELECT nom  FROM user2playlist inner join user u on user2playlist.id_user = u.id
            inner join playlist p on user2playlist.id_pl = p.id
            WHERE email = ?");
        $state->bindParam(1, $this->user);
        $state->execute();

        $playlists = [];
        while($data = $state->fetch())
        {
            $playlist = new Playlist($data['nom'], []);
            $playlist->ajouterPistes($playlist->getTrackList());
            $playlists[] = $playlist;

        }
        return $playlists;
    }
    
}