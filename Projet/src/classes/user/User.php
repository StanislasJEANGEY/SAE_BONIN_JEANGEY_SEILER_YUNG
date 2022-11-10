<?php

namespace iutnc\netVOD\user;


use Exception;
use iutnc\netVOD\action\ajouterCommentaireAction;
use iutnc\netVOD\db\ConnectionFactory;
use iutnc\netVOD\Exception\AuthException;

class User
{
    private String $email;
    private String $passwd;
    private int $role;
    private int $id;


    public function __construct(string $user, string $passwd, int $role, int $id)
    {
        $this->email = $user;
        $this->passwd = $passwd;
        $this->role = $role;
        $this->id = $id;
    }


    public function ajoutSerieFav(int $idSerie): bool
    {
        $db = ConnectionFactory::makeConnection();
        $query = $db->prepare("INSERT INTO favorite VALUES(?, ?)");
        $query->bindParam(1, $this->id);
        $query->bindParam(2,$idSerie);
        return $query->execute();
    }
    public function retirerSerieFav(int $idSerie): bool
    {
        $db = ConnectionFactory::makeConnection();
        $query = $db->prepare("DELETE from favorite WHERE iduser = ? AND idserie = ?");
        $query->bindParam(1, $this->id);
        $query->bindParam(2,$idSerie);
        return $query->execute();
    }

    public function EstFavorie(int $serieid): bool
    {
        $db = ConnectionFactory::makeConnection();
        $query = $db->prepare("SELECT idserie FROM favorite WHERE iduser = ? AND idserie = ?");
        $query->bindParam(1,$this->id);
        $query->bindParam(2,$serieid);
        $query->execute();
        return $query->rowCount() >= 1;
    }

    public function AjouterSerieCommencer(int $serieid):void{
      $db = ConnectionFactory::makeConnection();
      $query = $db->prepare("INSERT INTO current values(?,?)");
      $query->bindParam(1,$this->id);
      $query->bindParam(2,$serieid);
      $query->execute();
    }

    public function DejaCommencer(int $serieid):bool{
        $db = ConnectionFactory::makeConnection();
        $query = $db->prepare("SELECT idserie FROM current WHERE iduser = ? AND idserie = ?");
        $query->bindParam(1,$this->id);
        $query->bindParam(2,$serieid);
        $query->execute();
        return $query->rowCount() >= 1;
}

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    public function ajouterCommentaire(int $serieid, string $commentaire, int $note){
        $db = ConnectionFactory::makeConnection();
        $query = $db->prepare("INSERT INTO commentaire VALUES(?, ?, ?, ?)");
        $query->bindParam(1,$this->id);
        $query->bindParam(2,$serieid);
        $query->bindParam(3,$note);
        $query->bindParam(4,$commentaire);
        return $query->execute();
    }

    public function estCommenter(int $serieid){
        $db = ConnectionFactory::makeConnection();
        $query = $db->prepare("SELECT idserie FROM commentaire WHERE iduser = ? AND idserie = ?");
        $query->bindParam(1,$this->id);
        $query->bindParam(2,$serieid);
        $query->execute();
        return $query->rowCount() >= 1;
    }

    public function __get( string $attr) : mixed {
        if (property_exists($this, $attr)) return $this->$attr;
        else {
            throw new Exception("$attr : invalid property");}
    }






    /** a modif
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

  */

}
