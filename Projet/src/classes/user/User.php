<?php

namespace iutnc\netVOD\user;


use Exception;
use iutnc\netVOD\action\ajouterCommentaireAction;
use iutnc\netVOD\db\ConnectionFactory;
use iutnc\netVOD\Exception\AuthException;

class User
{
    private string $email;
    private string $passwd;
    private int $role;
    private int $id;
    private string $nom;
    private string $prenom;
    private string $genrePref;


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
        $query->bindParam(2, $idSerie);
        return $query->execute();
    }

    public function retirerSerieFav(int $idSerie): bool
    {
        $db = ConnectionFactory::makeConnection();
        $query = $db->prepare("DELETE from favorite WHERE iduser = ? AND idserie = ?");
        $query->bindParam(1, $this->id);
        $query->bindParam(2, $idSerie);
        return $query->execute();
    }

    public function EstFavorie(int $serieid): bool
    {
        $db = ConnectionFactory::makeConnection();
        $query = $db->prepare("SELECT idserie FROM favorite WHERE iduser = ? AND idserie = ?");
        $query->bindParam(1, $this->id);
        $query->bindParam(2, $serieid);
        $query->execute();
        return $query->rowCount() >= 1;
    }

    public function AjouterSerieCommencer(int $serieid): void
    {
        $db = ConnectionFactory::makeConnection();
        $query = $db->prepare("INSERT INTO current values(?,?)");
        $query->bindParam(1, $this->id);
        $query->bindParam(2, $serieid);
        $query->execute();
    }

    public function DejaCommencer(int $serieid): bool
    {
        $db = ConnectionFactory::makeConnection();
        $query = $db->prepare("SELECT idserie FROM current WHERE iduser = ? AND idserie = ?");
        $query->bindParam(1, $this->id);
        $query->bindParam(2, $serieid);
        $query->execute();
        return $query->rowCount() >= 1;
    }

    public function ajouterCommentaire(int $serieid, string $commentaire, int $note)
    {
        $db = ConnectionFactory::makeConnection();
        $query = $db->prepare("INSERT INTO commentaire VALUES(?, ?, ?, ?)");
        $query->bindParam(1, $this->id);
        $query->bindParam(2, $serieid);
        $query->bindParam(3, $note);
        $query->bindParam(4, $commentaire);
        return $query->execute();
    }

    public function estCommenter(int $serieid)
    {
        $db = ConnectionFactory::makeConnection();
        $query = $db->prepare("SELECT idserie FROM commentaire WHERE iduser = ? AND idserie = ?");
        $query->bindParam(1, $this->id);
        $query->bindParam(2, $serieid);
        $query->execute();
        return $query->rowCount() >= 1;
    }

    public function ajoutBDDInfos() : void
    {
        $bd = ConnectionFactory::makeConnection();
        $update = $bd->prepare("UPDATE Utilisateur SET nom = ? WHERE id = $this->id");
        $update->bindParam(1,$this->nom);
        $update->execute();
        $update = $bd->prepare("UPDATE Utilisateur SET prenom = ? WHERE id = $this->id");
        $update->bindParam(1,$this->prenom);
        $update->execute();
        $update = $bd->prepare("UPDATE Utilisateur SET genrePref = ? WHERE id = $this->id");
        $update->bindParam(1,$this->genrePref);
        $update->execute();
    }

    public function __get(string $attr): mixed
    {
        if (property_exists($this, $attr)) return $this->$attr;
        else {
            throw new Exception("$attr : invalid property");
        }
    }

    public function __set( string $attr, mixed $val) : void {
        if (property_exists($this, $attr)) $this->$attr = $val;
        else throw new Exception("$attr : invalid property");
    }

}
