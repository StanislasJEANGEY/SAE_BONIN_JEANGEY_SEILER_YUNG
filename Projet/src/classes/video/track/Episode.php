<?php

namespace iutnc\netVOD\video\track;

use iutnc\netVOD\db\ConnectionFactory;

class Episode extends video
{
    public mixed $descriptif;
    public $idSerie;
    public $numero;

    public function __construct(string $id, string $title, int $duration, string $resume, string $source, int $idS,int $num)
    {
        parent::__construct($id, $title, $duration, $resume, $source);
        $this->idSerie = $idS;
        $this->numero = $num;
    }

    public static function getEpisode(string $id): Episode
    {
        $bd = ConnectionFactory::makeConnection();
        $requete = $bd->prepare("SELECT * FROM episode WHERE id = ?");
        $requete->bindParam(1, $id);
        $requete->execute();
        while ($data = $requete->fetch()) {
            $episode = new Episode($data['id'], $data['titre'], $data['duree'], $data['resume'], $data['file'], $data['serie_id'],$data['numero']);
        }
        return $episode;
    }
}
