<?php
/**
 * Created by PhpStorm.
 * User: Denier
 * Date: 27/11/2017
 * Time: 20:41
 */

include_once ("module/profilMembre/Seances/Modele.php");
include_once ("module/profilMembre/Seances/Vue.php");

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
        if(!isset($_GET['seance'])){
            if(isset($_POST['submit'])){
                if($this->modele->rentrer_stat()){
                    //$this->modele->suppSeance();
                }
            }
            $liste = $this->modele->listSeance();
            $this->vue->affichePage('list_seance', $liste);
        }else{
            if(isset($_GET['submit'])){
                $liste = $this->modele->listExercice();
                $this->vue->affichePage('Submit_seance', $liste);
            }elseif(isset($_POST['submit'])){
                $this->modele->rentrer_stat();
                //$this->modele->suppSeance();
                $liste = $this->modele->listSeance();
                $this->vue->affichePage('list_seance', $liste);

            }else{
                $liste = $this->modele->listExercice();
                $this->vue->affichePage('list_exercice', $liste);
            }


        }
    }

}