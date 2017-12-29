<?php
/**
 * Created by PhpStorm.
 * User: Denier
 * Date: 27/11/2017
 * Time: 20:41
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

    function listSeance(){
        $sql = 'SELECT * FROM Seance INNER JOIN Client ON Seance.pseudo_client = Client.pseudo_client WHERE Client.pseudo_client = ?';
        $requete = $this->bdd->prepare($sql);
        $pseudo = $_SESSION['pseudo'];
        $requete->execute(array($pseudo));
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    function listExercice(){
        $sql = 'SELECT nom_exercice, charge, temps_repos, tempo, repetitions FROM Seance INNER JOIN Exercice ON Seance.id_seance = Exercice.id_seance WHERE Seance.id_seance = ?';
        $requete = $this->bdd->prepare($sql);
        $id = $_GET['seance'];
        $requete->execute(array($id));
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    function listSeanceStat(){
        $sql = 'SELECT * FROM Seance_stat INNER JOIN Client ON Seance_stat.pseudo_client = Client.pseudo_client WHERE Client.pseudo_client = ?';
        $requete = $this->bdd->prepare($sql);
        $pseudo = $_SESSION['pseudo'];
        $requete->execute(array($pseudo));
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    function listExerciceStat(){
        $sql = 'SELECT nom_exercice_stat, charge, temps_repos, tempo, repetitions FROM Seance_stat INNER JOIN Exercice_stat ON Seance_stat.id_seance_stat = Exercice_stat.id_seance_stat WHERE Seance_stat.id_seance_stat = ?';
        $requete = $this->bdd->prepare($sql);
        $id = $_GET['seance'];
        $requete->execute(array($id));
        return $requete->fetchAll(PDO::FETCH_ASSOC);
    }

    function rentrer_stat(){

        try{

            $this->CreerSeanceStat();
            $this->CreerExerciceStat();
            return true;

        }catch(PDOException $e){
            echo "Erreur!: " . $e->getMessage() . "<br/>";
            return false;
        }
    }

    function CreerSeanceStat(){
        $sql = 'INSERT INTO Seance_stat (id_seance_stat, nom_seance_stat, commentaire_perso, pseudo_client) VALUES (?,?,?,?)';
        $requete = $this->bdd->prepare($sql);
        $nom = "Seance du " . date("d.m.y");
        $com = $_POST['commentaire'];
        $pseudo = $_SESSION['pseudo'];
        $id = $_GET['seance'];
        $requete->execute(array($id, $nom, $com, $pseudo));
    }

    function CreerExerciceStat(){
        $sql = 'SELECT count(id_exercice) AS nbExo FROM Exercice WHERE id_seance = ?';
        $requete = $this->bdd->prepare($sql);
        $requete->execute(array($_GET['seance']));

        $nb = $requete->fetch(PDO::FETCH_ASSOC);
        for($j = 0; $j<$nb['nbExo']; $j++){
            $sql = 'INSERT INTO Exercice_stat (nom_exercice_stat, charge, temps_repos, repetition, id_seance_stat) VALUES (?,?,?,?,?)';
            $requete = $this->bdd->prepare($sql);

            //charge
            $i = 1;
            $charge = $_POST[$j.'charge0'];
            while (isset($_POST[$j.'charge'.$i])){
                $charge .= '-'.$_POST[$j.'charge'.$i];
                $i++;
            }

            //temps repos
            $i = 1;
            $repos = $_POST[$j.'repos0'];
            while (isset($_POST[$j.'repos'.$i])){
                $repos .= '-'.$_POST[$j.'repos'.$i];
                $i++;
            }

            //repetitions
            $i = 1;
            $rep = $_POST[$j.'rep0'];
            while (isset($_POST[$j.'rep'.$i])){
                $rep .= '-'.$_POST[$j.'rep'.$i];
                $i++;
            }

            $requete->execute(array(
                $_POST['nom'],
                $charge,
                $repos,
                $rep,
                $_GET['seance']
            ));
        }
    }

    function suppSeance(){

        $sql = 'DELETE FROM Exercice WHERE id_seance = ?';
        $requete = $this->bdd->prepare($sql);
        $id = $_GET['seance'];
        $requete->execute(array($id));

        $sql = 'DELETE FROM Seance WHERE id_seance = ?';
        $requete = $this->bdd->prepare($sql);
        $requete->execute(array($id));
    }
}