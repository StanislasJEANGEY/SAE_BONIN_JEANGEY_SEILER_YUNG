<?php

namespace iutnc\netVOD\renderer;

use iutnc\netVOD\db\ConnectionFactory;
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
                            <span id="nom"><label id="labelNom">Nom : </label><br><input id="TextLogin" type="text" name="nom" value="" placeholder='Saisir nom' required><br></span>
                            <span id="prenom"><label id="labelPrenom">Prénom : </label><br><input id="TextLogin" type="text" name="prenom" value="" placeholder='Saisir prénom' required><br></span>
                            <span id="genre"><label id="labelGenre">Genre préféré : </label><br>
                              <select name="genre">
                                  <option value="">Fais ton choix</option>
                                  <option value="Comédie">Comédie</option>
                                  <option value="Horreur">Horreur</option>
                              </select>

                            <button id="buttonAjout" type="submit">Ajouter</button>
                        </form>
                        EOF;
                $html .= "<a id=retourConnexion href='?action=signin'>Retour à la connexion</a><br><br>";
                break;
            case 2 :
                $user = unserialize($_SESSION['user']);
                $userid = $user->__get('id');
                $bd = ConnectionFactory::makeConnection();
                $req = $bd->prepare("SELECT nom, prenom, genrePref FROM Utilisateur WHERE id = ?");
                $req->bindParam(1, $userid);
                $req->execute();
                $data= $req->fetchAll();
                $html = "
                        Nom : " . $data[0]['nom'] . "<br>
                        Prenom : " . $data[0]['prenom'] . "<br>
                        Genre préféré : " . $data[0]['genrePref'] . "<br>";
                $html .= "<a href='?action=modifyProfil'>Modifier</a>";
                $html .= "<a id=retourConnexion href='?action=signin'>Retour à la connexion</a><br><br>";
                break;
        }
        return $html;
    }
}
