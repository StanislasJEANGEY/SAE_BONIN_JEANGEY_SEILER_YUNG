<?php
namespace iutnc\netVOD\video\list;

use Exception;
use iutnc\netVOD\db\ConnectionFactory;

class Serie {
    protected $idSerie;
    protected $titre;
    protected $descriptif;
    protected $image;
    protected $annee;

    public function __construct(string $ids, string $title, string $descrip, string $img, string $an) {
        $this->idSerie = $ids;
        $this->titre = $title;
        $this->descriptif = $descrip;
        $this->image = $img;
        $this->annee = $an;
    }

    public function __get( string $attr) : mixed {
        if (property_exists($this, $attr)) return $this->$attr;
        else {
            throw new Exception("$attr : invalid property");}
    }

    public function __set( string $attr, mixed $val) : void {
        if (property_exists($this, $attr)) $this->$attr = $val;
        throw new Exception("$attr : invalid property");
    }

    public static function getSerie(string $id) : Serie
    {
        $bd = ConnectionFactory::makeConnection();
        $requete = $bd->prepare("SELECT * FROM serie WHERE id = ?");
        $requete->bindParam(1, $id);
        $requete->execute();
        while ( $data = $requete->fetch()){
            $serie = new Serie($data['id'], $data['titre'], $data['descriptif'], $data['img'], $data['annee']);
        }

        return $serie;
    }

}