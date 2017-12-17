<?php
/**
 * Created by PhpStorm.
 * User: Denier
 * Date: 11/11/2017
 * Time: 15:00
 */

include_once ("module/acceuilMembre/Modele.php");
include_once ("module/acceuilMembre/Vue.php");

class Controler
{
    private $modele;
    private $vue;

    function __construct()
    {
        $this->modele = new Modele();
        $this->vue = new Vue();
    }

    function launch(){

        if(!isset($_SESSION['profil'])){
            $this->modele->recupInfo();
        }
        if($_SESSION['profil']['premiere_connexion'] == true){
            if(isset($_POST['firstCo'])){
                $this->modele->firstCo();
                $this->vue->affichePage();
            }else {
                $this->vue->affichePage('first');
            }
        }else {
            $this->vue->affichePage();
        }
    }
}