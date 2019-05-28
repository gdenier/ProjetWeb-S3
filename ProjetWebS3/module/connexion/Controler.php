<?php
/**
 * Created by PhpStorm.
 * User: Denier
 * Date: 11/11/2017
 * Time: 15:00
 */

include_once ("module/connexion/Modele.php");
include_once ("module/connexion/Vue.php");

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
        if(isset($_POST['envoyer'])){
            if($this->modele->connexion($_POST['pseudo'], $_POST['motDePasse'])){

                $_SESSION['pseudo'] = $_POST['pseudo'];
                $_SESSION['type'] = 'client';

                if(isset($_POST['remember'])){
                    setcookie('pseudo', $_POST['pseudo'], time()+3600*24*365, null, null, true, true);
                }

                header('Location: https://livesport.onl');

            }else{
                $this->vue->affichePage('erreur');
            }
        }elseif(isset($_GET['recup_mdp'])){

            if($_GET['recup_mdp'] == 'on'){
                $this->modele->RecupMDP($_POST['email']);
                $this->vue->affichePage('attente', $_POST['email']);
            }elseif($_GET['recup_mdp'] == 'in'){
                if($this->modele->verifRecup($_GET['selector'], $_GET['validator'])){
                    $this->vue->affichePage('changement');
                }else{
                    echo 'Que faites-vous là?';
                }
            }elseif($_GET['recup_mdp'] == 'true'){
                $this->vue->affichePage('oublie');
            }elseif ($_GET['recup_mdp'] == 'out'){
                $this->modele->modifMDP();
                $_SESSION['type'] = 'client';
                header('Location: https://livesport.onl');
            }

        }else{
            $this->vue->affichePage('debut');

        }

    }

    function setPseudo($pseudo){
        $_SESSION['pseudo'] = $pseudo;
        return true;
    }
}