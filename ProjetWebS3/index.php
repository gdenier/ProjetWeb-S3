<?php
/**
 * Created by PhpStorm.
 * User: Denier
 * Date: 05/11/2017
 * Time: 16:27
 */

class index
{
    function __construct()
    {

        if(session_id() != '')
        {
            session_destroy();
        }
        session_start(); session_regenerate_id(true);
        if(isset($_COOKIE['pseudo']) && !empty($_COOKIE['pseudo'])){
            $_SESSION['pseudo'] = $_COOKIE['pseudo'];
            $_SESSION['type'] = 'client';
        }
        if(isset($_SESSION['pseudo'],$_SESSION['type'])){
            $this->launchMembre();
        }else{
            $this->launchVisiteur();
        }
    }

    function launchVisiteur(){
        if (isset($_GET['module'])) {
            switch ($_GET['module']) {
                case 'forum':
                    include_once("module/forum/Controler.php");
                    $controler = new Controler();
                    $controler->launch();
                    break;
                case 'inscription':
                    include_once("module/inscription/Controler.php");
                    $controler = new Controler();
                    $controler->launch();
                    break;
                case 'connexion':
                    include_once("module/connexion/Controler.php");
                    $controler = new Controler();
                    $controler->launch();
                    break;
                default:

                    break;

            }
        } else {
            include_once("module/acceuilVisiteur/Controler.php");
            $controler = new Controler();
            $controler->launch();
        }
    }

    function launchMembre(){

        if(isset($_GET['module'])){
            switch($_GET['module']){
                case 'logout':
                    session_unset();
                    header('Location: https://livesport.onl');
                    break;
                case 'seance':
                    include_once("module/profilMembre/Seances/Controler.php");
                    $controler = new Controler();
                    $controler->launch();
                    break;
                default:
                    echo 'default';
                    break;
            }
        }else{
            include_once("module/acceuilMembre/Controler.php");
            $controler = new Controler();
            $controler->launch();
        }
    }


}

new index();