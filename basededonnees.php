<?php

class Basededonnees
{
    private static $dbHost="localhost";
    private static $dbName="tp2annuaire";
    private static $dbUser="root";
    private static $dbPassword="";

    private static $connection = null;

    public static function connecter()
    {

            try{

                self::$connection = new PDO("mysql:host=" . self::$dbHost . ";dbname=" . self::$dbName,
                 self::$dbUser,self::$dbPassword,array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            }
            catch(PDOException $erreur){
                    
                die('ERREUR: '.$erreur->getMessage());
            }
            return self::$connection;
                        
    }
    public static function deconnecter()
    {
        self::$connection = null;
    }

}

        
?>