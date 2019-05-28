<?php
/**
 * Created by PhpStorm.
 * User: Denier
 * Date: 11/11/2017
 * Time: 15:00
 */

include_once ("module/non_connecte/acceuil/vue.php");

class Controler
{
    private $vue;

    function __construct()
    {
        $this->vue = new Vue();
        $this->launch();
    }

    function launch(){
        $this->vue->affichePage();
    }
}