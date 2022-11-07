<?php

namespace iutnc\netVOD\db;

use PDO;

class ConnectionFactory
{

    private static array $config = [];
    private static ?PDO $db = null;

    public static function setConfig(String $file = "config.ini")
    {
        ConnectionFactory::$config = parse_ini_file($file);
        
    }

    public static function makeConnection()
    {
        if(self::$db == null)
        {
            $dbname = self::$config['dbname'];
            $host = self::$config['host'];
            $pass = self::$config['password'];
            $user = self::$config['user'];
            $dns = "mysql:host=$host;dbname=$dbname";

            try {
                self::$db = new PDO($dns, $user, $pass);
                self::$db->exec('SET NAMES \'UTF8\'');

            } catch (PDOException $e) {
                print "Erreur !: " . $e->getMessage() . "<br/>";
                die();
            }
            return self::$db;
        }
        return self::$db;

    }


}