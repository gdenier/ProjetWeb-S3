<?php


class Index
{

    function __construct()
    {

        if(session_id() != '')
        {
            session_destroy();
        }
        session_start(); session_regenerate_id(true);

        if(isset($_COOKIE['pseudo']) && isset($_COOKIE['mdp']) && !empty($_COOKIE['pseudo']) && !empty($_COOKIE['mdp'])){

            if(isset($_COOKIE['type']) && $_COOKIE['type'] == 'client'){
                include_once ("module/non_connecte/connexion/client/modele.php");
                if(Connection::connexionCookie($_COOKIE['pseudo'], $_COOKIE['mdp'])){
                    $_SESSION['pseudo'] == $_COOKIE['pseudo'];
                    $_SESSION['type'] == $_COOKIE['type'];
                }

            }elseif(isset($_COOKIE['type']) && $_COOKIE['type'] == 'coach'){
                include_once ("module/non_connecte/connexion/coach/modele.php");
                if(Modele::connexionCookie($_COOKIE['pseudo'], $_COOKIE['mdp'])){
                    $_SESSION['pseudo'] == $_COOKIE['pseudo'];
                    $_SESSION['type'] == $_COOKIE['type'];
                }
            }
        }

        if(isset($_SESSION['pseudo'],$_SESSION['type'])){
            if($_SESSION['type'] == 'client'){
                $this->launchClient();
            }else{
                $this->launchCoach();
            }
        }else{
            $this->launchVisiteur();
        }

    }

    function launchClient(){

        if(isset($_GET['module'])){
            switch($_GET['module']){
                case 'profil':
                    include_once ("module/client/profil/controler.php");
                    new Controler();
                    break;
                case 'seance':
                    include_once ("module/client/seance/controler.php");
                    new Controler();
                    break;
                case 'forum':
                    include_once ("module/forum/controler.php");
                    new Controler();
                    break;
            }
        }else{
            include_once ("module/client/profil/controler.php");
            new Controler();
        }

    }

    function launchCoach(){
        if(isset($_GET['module'])){
            switch($_GET['module']){
                case 'profil':

                    break;
            }
        }else{

        }
    }

    function launchVisiteur(){
        if(isset($_GET['module'])){
            switch($_GET['module']){
                case 'acceuil':
                    include_once("module/non_connecte/acceuil/controler.php");
                    new Controler();
                    break;
                case 'connexion':
                    include_once ("module/non_connecte/connexion/controler.php");
                    new Controler();
                    break;
                case 'inscription':
                    include_once ("module/non_connecte/inscription/controler.php");
                    new Controler();
                    break;
            }
        }else{
            include_once("module/non_connecte/acceuil/controler.php");
            new Controler();
        }
    }

}

new Index();