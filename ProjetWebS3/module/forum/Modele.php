<?php
/**
 * Created by PhpStorm.
 * User: Denier
 * Date: 05/11/2017
 * Time: 15:07
 */

include_once ("module/Parametre_connexion.php");

class Modele extends Parametre_connexion
{
    private $bdd;

    function __construct()
    {
        parent::__construct();
        try {
            $this->bdd = new PDO("mysql:host=$this->host_name; dbname=$this->database;", $this->user_name, $this->password);
            echo 'good';
        } catch (PDOException $e) {
            echo "Erreur!: " . $e->getMessage() . "<br/>";
            die();
        }
        
    }

    function recupTheme(){
        $sql = "SELECT * FROM Forum";
        $requete = $this->bdd->prepare($sql);
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    function recupSujet($theme){
        $sql = "SELECT * FROM SujetForum WHERE id_forum = ".$theme;
        $requete = $this->bdd->prepare($sql);
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    function recupMessage($sujet){
        $sql = "SELECT * FROM MessageForum WHERE id_sujet=".$sujet;
        $requete = $this->bdd->prepare($sql);
        $requete->execute();
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }
}