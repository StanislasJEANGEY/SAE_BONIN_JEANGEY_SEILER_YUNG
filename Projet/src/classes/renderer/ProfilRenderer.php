<?php

namespace iutnc\netVOD\renderer;

use iutnc\netVOD\user\User;

class ProfilRenderer implements renderer
{
    protected User $profil;

    /**
     * @param User $profil
     */
    public function __construct(User $profil)
    {
        $this->profil = $profil;
    }


    public function render(int $selector = 1): string
    {
        switch ($selector) {
            case 1:
                $html = <<<EOF
                        <form method='post' action='?action=profil'>
                            <span id="nom"><label id="labelNom">Nom : </label><br><input id="textNom" type="text" name="nom" value="" placeholder='Saisir nom'><br></span>
                            <span id="prenom"><label id="labelPrenom">Prénom : </label><br><input id="textPrenom" type="text" name="prenom" value="" placeholder='Saisir prénom'><br></span>
                            <span id="genre"><label id="labelGenre">Genre préférer : </label><br><input id="textGenre" type="text" name="genrePref" value="" placeholder='Saisir genre préféré'><br></span>
                            <button id="buttonAjout" type="submit">Ajouter</button>
                        </form>
                        EOF;
                break;
            case 2 :
                $html = "
                        Nom : " . $this->profil->__get("nom") . "<br>
                        Prenom : " . $this->profil->__get("prenom") . "<br>
                        Genre préféré : " . $this->profil->__get("genrePref") . "<br>
                        ";
                break;
        }
        return $html;
    }
}