<?php

include_once ("module/Parametre_connexion.php");

class Modele extends Parametre_connexion
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
        $sql = "SELECT pseudo_coach, mdp_coach FROM Coach";
        $requete = $this->bdd->prepare($sql);
        $requete->execute();
        $donnee = $requete->fetchAll(PDO::FETCH_ASSOC);

        foreach ($donnee as $record){
            if($record['pseudo_coach'] == $login) {

                include_once("src/crypto/key.php");
                $salt = crypt($record['pseudo_coach'], $key);

                if (password_verify($mdp.$salt, $record['mdp_coach'])) {

                    $_SESSION['pseudo'] = $login;
                    $_SESSION['type'] = 'coach';

                    return true;
                } else {
                    return false;
                }
            }
        }
        return false;
    }

}