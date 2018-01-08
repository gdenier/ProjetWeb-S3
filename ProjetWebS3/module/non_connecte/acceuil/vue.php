<?php
/**
 * Created by PhpStorm.
 * User: Denier
 * Date: 11/11/2017
 * Time: 15:00
 */

class Vue
{

    private $nav = '';
    private $contenu = '';

    function affichePage(){

        $this->afficheMenu();
        include_once ("src/html/page.html");

    }

    function afficheMenu(){
        $this->contenu .='
            <a href="index.php">acceuil</a>
            <a href="index.php?module=inscription&type=client">inscription Client</a>
            <a href="index.php?module=inscription&type=coach">inscription Coach</a>
            <a href="index.php?module=connexion&type=client">connexion Client</a>
            <a href="index.php?module=connexion&type=coach">connexion Coach</a>                  
        ';
    }

}

