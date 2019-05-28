<?php

include_once ("module/Parametre_connexion.php");

class Connection extends Parametre_connexion
{

    private $bdd;

    function __construct()
    {
        parent::__construct();
        try {
            $this->bdd = new PDO("mysql:host=$this->host_name; dbname=$this->database;", $this->user_name, $this->password);
            $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Erreur!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    function connexion($login, $mdp){
        $sql = "SELECT pseudo_client, mdp_client FROM Client";
        $requete = $this->bdd->prepare($sql);
        $requete->execute();
        $donnee = $requete->fetchAll(PDO::FETCH_ASSOC);

        foreach ($donnee as $record){
            if($record['pseudo_client'] == $login) {

                include_once("src/crypto/key.php");
                $salt = crypt($record['pseudo_client'], $key);

                if (password_verify($mdp.$salt, $record['mdp_client'])) {

                    $_SESSION['pseudo'] = $login;
                    $_SESSION['type'] = 'client';

                    return true;
                } else {
                    return false;
                }
            }
        }
        return false;
    }

    function decryptIt( $q ) {
        $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
        $qDecoded      = rtrim( mcrypt_decrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), base64_decode( $q ), MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ), "\0");
        return( $qDecoded );
    }

    function connexionCookie($login, $mdp){

        $host_name = 'db706681381.db.1and1.com';
        $database = 'db706681381';
        $user_name = 'dbo706681381';
        $password = 'SPcoa-17';

        $bdd = new PDO("mysql:host=$host_name; dbname=$database;", $user_name, $password);
        $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $sql = "SELECT pseudo_client, mdp_client FROM Client WHERE pseudo_client=?";
        $requete = $bdd->prepare($sql);
        $requete->execute(array($login));
        $donnee = $requete->fetch(PDO::FETCH_ASSOC);

        include_once("src/crypto/key.php");
        $salt = crypt($donnee['pseudo_client'], $key);

        $mdpDecrypted = Connection::decryptIt($mdp);

        if (password_verify($mdpDecrypted.$salt, $donnee['mdp_client'])) {

            $_SESSION['pseudo'] = $login;
            $_SESSION['type'] = 'client';

            return true;
        } else {
            echo 'false';
            return false;
        }

    }

}