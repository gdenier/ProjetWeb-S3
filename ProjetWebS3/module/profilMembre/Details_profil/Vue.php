<?php
/**
 * Created by PhpStorm.
 * User: Denier
 * Date: 27/11/2017
 * Time: 20:41
 */

class Vue
{

    private $nav = '';
    private $contenu = '';

    function affichePage($type, $contenu = null){
        $this->afficherMenu();

        include_once ("src/html/page.html");
    }

    function afficherMenu(){
        $this->nav .= '
            <h1>Bonjour, '. $_SESSION['pseudo'] .'</h1>
            <nav>
                <ul>
                    <li><a href="https://livesport.onl">HOME</a></li>
                    <li><a href="https://livesport.onl?module=profil">Profil</a></li>
                    <li><a href="https://livesport.onl?module=seance">Séances</a></li>
                    <li><a href="https://livesport.onl?module=forum">Forum</a></li>
                    <li><a href="https://livesport.onl?module=logout">Deconnexion</a></li>
                </ul>
            </nav>
        ';
    }
    
}