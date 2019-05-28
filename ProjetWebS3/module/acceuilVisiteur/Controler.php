<?php
/**
 * Created by PhpStorm.
 * User: Denier
 * Date: 11/11/2017
 * Time: 15:00
 */

include_once ("module/acceuilVisiteur/Vue.php");

class Controler
{
    private $vue;

    function __construct()
    {
        $this->vue = new Vue();
    }

    function launch(){
        $this->vue->affichePage();
    }
}