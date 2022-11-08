<?php

namespace iutnc\netVOD\video\track;

use iutnc\netVOD\db\ConnectionFactory;

class Episode extends video
{
    protected $idSaison;

    public function __construct(string $title, int $duration, string $resume, string $source, int $idS)
    {
        parent::__construct($title, $duration, $resume, $source);
        $this->idSaison = $idS;
    }

    public static function getEpisode(string $id): Episode
    {
        $bd = ConnectionFactory::makeConnection();
        $requete = $bd->prepare("SELECT * FROM episode WHERE id = ?");
        $requete->bindParam(1, $id);
        while ($data = $requete->fetch()) {
            $episode = new Episode($data['titre'], $data['duree'], $data['resume'], $data['file'], $data['serie_id']);
        }
        return $episode;
    }
}