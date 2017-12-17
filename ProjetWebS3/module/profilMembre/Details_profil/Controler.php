<?php
/**
 * Created by PhpStorm.
 * User: Denier
 * Date: 27/11/2017
 * Time: 20:41
 */

include_once ("module/profilMembre/Details_profil/Modele.php");
include_once ("module/profilMembre/Details_profil/Vue.php");

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

    }

}