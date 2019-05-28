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
}