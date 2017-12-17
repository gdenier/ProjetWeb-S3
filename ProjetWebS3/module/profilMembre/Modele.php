<?php
/**
 * Created by PhpStorm.
 * User: Denier
 * Date: 11/11/2017
 * Time: 15:00
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
            $this->bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Erreur!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    function recupInfo(){
        $sql = "SELECT * FROM Client WHERE pseudo=?";
        $requete = $this->bdd->prepare($sql);
        $requete->execute(array($_SESSION['pseudo']));

        $_SESSION['profil'] = $requete->fetch(PDO::FETCH_ASSOC);

    }

    function firstCo(){
        $sql = "UPDATE Client SET nom=?, prenom=?, sexe=?, age=?, premiere_connexion=?, objectif=?, poids=?, taille=?, nb_jour_par_semaine=?, materiel=? WHERE pseudo=?";
        $requete = $this->bdd->prepare($sql);
        $requete->execute(array(
            $_POST['nom'],
            $_POST['prenom'],
            $_POST['sexe'],
            $_POST['age'],
            null,
            $_POST['objectif'],
            $_POST['poids'],
            $_POST['taille'],
            $_POST['nbj'],
            $_POST['materiel'],
            $_SESSION['pseudo']
        ));
    }

}