<?php



class Controler
{
    private $modele;
    private $vue;

    function __construct()
    {
        if(isset($_GET['logout'])){

            session_unset();
            if(isset($_COOKIE['pseudo'])){
                setcookie("pseudo", "", time()-3600);
            }
            if(isset($_COOKIE['mdp'])){
                setcookie("mdp", "", time()-3600);
            }
            if(isset($_COOKIE['type'])){
                setcookie("type", "", time()-3600);
            }

            header('Location: https://livesport.onl');

        }elseif(isset($_GET['vision'])) {
            if ($_GET['visio'] == 'statistique') {

                include_once("module/client/profil/statistique/modele.php");
                include_once("module/client/profil/statistique/vue.php");

            } else {

                include_once("module/client/profil/information/modele.php");
                include_once("module/client/profil/information/vue.php");

            }
        }else{

            include_once("module/client/profil/information/modele.php");
            include_once("module/client/profil/information/vue.php");

        }


        $this->modele = new Modele();
        $this->vue = new Vue();

        $this->launch();
    }

    function launch(){

        if(!isset($_SESSION['profil'])){
            $this->modele->recupInfo();
        }

        if(isset($_POST['envoyer'])){

            //TODO: je sais plus

        }elseif($_SESSION['profil']['premiere_connexion'] == true){

            if(isset($_POST['firstCo'])){
                $this->modele->firstCo();
                $this->modele->recupInfo();
                $this->vue->affichePage('base');
            }else {
                $this->vue->affichePage('premiereCo');
            }

        }else{

            $this->vue->affichePage('base');

        }

    }

}