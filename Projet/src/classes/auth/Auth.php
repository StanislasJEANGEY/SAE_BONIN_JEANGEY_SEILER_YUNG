<?php

namespace iutnc\netVOD\auth;

use iutnc\netVOD\db\ConnectionFactory;
use iutnc\netVOD\Exception\AuthException;
use iutnc\netVOD\user\User;

class Auth
{


    public static function register(string $email, string $password): bool
    {
        $verify = false;
        if (strlen($password) >= 8) {
            $email = filter_var($email, FILTER_SANITIZE_EMAIL);
            $db = ConnectionFactory::makeConnection();
            $state = $db->prepare("SELECT email FROM Utilisateur WHERE email = :email");
            $state->execute([':email' => $email]);
            if ($state->rowCount() == 0) {

                $passHash = password_hash($password, PASSWORD_DEFAULT, ["cost" => 12]);
                $state = $db->prepare("INSERT INTO Utilisateur (email, passwd, role) VALUES (?,?,?)");
                $state->execute([$email, $passHash, 1]);
                $verify = true;
            } else {
                throw new AuthException("Utilisateur existant");
            }
            $state->closeCursor();
        } else {
            throw new AuthException("Mot de passe invalide (min cara)");
        }
        return $verify;
    }

    public static function authenticate(string $email, string $password): User
    {
        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $db = ConnectionFactory::makeConnection();
        $state = $db->prepare("SELECT passwd, role, id FROM Utilisateur WHERE email = :user");
        $state->execute([':user' => $email]);

        $array = $state->fetchAll();

        if (empty($array)) {
            throw new AuthException("Email invalide !");
        }

        $passVerif = $array[0]['passwd'];
        $role = $array[0]['role'];
        $id = $array[0]['id'];

        if (!password_verify($password, $passVerif)) {
            throw new AuthException("Mot de passe invalide !");
        }

        $user = new User($email, $passVerif, $role, $id);
        $_SESSION['user'] = serialize($user);
        return $user;
    }

    public static function logout()
    {
        unset($_SESSION['user']);
    }

    public static function isAuthorized($idPlaylist): bool
    {
        $user = $_SESSION['user'];
        if (empty($user)) {
            return false;
        }

        $user = unserialize($user);
        if ($user->getRole() == 100) {
            return true;
        }
        $db = ConnectionFactory::makeConnection();
        $state = $db->prepare("SELECT id FROM user WHERE email = ?");
        $state->execute([$user->getEmail()]);
        $id = $state->fetchAll()[0]['id'];
        $state = $db->prepare("SELECT id_pl FROM user2playlist WHERE id_user = ?");
        $state->execute([$id]);
        while ($res = $state->fetch()) {
            if ($res['id_pl'] == $idPlaylist) {
                $state->closeCursor();
                return true;
            }
        }
        $state->closeCursor();
        return false;
    }
}
