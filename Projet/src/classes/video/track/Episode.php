<?php

namespace iutnc\netVOD\video\track;

use iutnc\netVOD\db\ConnectionFactory;

class Episode extends video
{
    public mixed $descriptif;
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
        $requete->execute();
        while ($data = $requete->fetch()) {
            print $data['titre'].'<br>';
            print $data['duree'].'<br>';
            print $data['resume'].'<br>';
            print $data['file'].'<br>';
            print $data['serie_id'].'<br>';
            $episode = new Episode($data['titre'], $data['duree'], $data['resume'], $data['file'], $data['serie_id']);
        }
        return $episode;
    }
}