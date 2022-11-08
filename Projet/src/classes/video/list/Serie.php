<?php
namespace iutnc\netVOD\video\list;

use Exception;

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

}