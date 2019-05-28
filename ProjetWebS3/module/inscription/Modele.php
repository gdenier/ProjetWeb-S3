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

    function VerifDouble($pseudo, $mail){
        $sql = "SELECT pseudo_client, email_client FROM Client";
        $requete = $this->bdd->prepare($sql);
        $requete->execute();
        $donnee = $requete->fetchAll(PDO::FETCH_ASSOC);

        foreach ($donnee as $record){
            if($pseudo == $record['pseudo_client']){
                return 'pseudo';
            }
            if($mail == $record['mail_client']){
                return 'mail';
            }
        }
        return false;
    }

    function verifMail($mail){
        if (filter_var($mail, FILTER_VALIDATE_EMAIL) != false) {
            return true;
        } else {
            return false;
        }
    }

    function inscription(){
        $sql = "INSERT INTO Client (email_client, pseudo_client, mdp_client, premiere_connexion) VALUES (?,?,?,?)";

        $requete = $this->bdd->prepare($sql);
        if($_POST['motDePasse'] == $_POST['motDePasse2']) {
            if ($_POST['mail'] == $_POST['mail2']) {

                include_once ("src/crypto/key.php");

                $salt = crypt($_POST['pseudo'], $key);

                $pass = password_hash($_POST['motDePasse'].$salt, PASSWORD_BCRYPT);

                try {
                    $requete->execute(array($_POST['mail'], $_POST['pseudo'], $pass, 1)); return true;
                } catch (PDOException $e) {
                    echo "Erreur!: " . $e->getMessage() . "<br/>";
                    return false;
                }



            }else{
                return false;
            }
        }else{
            return false;
        }
    }

}