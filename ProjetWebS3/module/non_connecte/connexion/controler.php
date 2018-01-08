<?php

class Controler
{

    private $modele;
    private $vue;

    function __construct()
    {

        if(isset($_GET['type'])){
            if($_GET['type'] == 'client'){

                include_once ("module/non_connecte/connexion/client/modele.php");
                include_once ("module/non_connecte/connexion/client/vue.php");

            }elseif($_GET['type'] == 'coach'){

                include_once ("module/non_connecte/connexion/coach/modele.php");
                include_once ("module/non_connecte/connexion/coach/vue.php");

            }elseif (isset($_GET['recup_mdp'])){

                include_once ("module/non_connecte/connexion/mdp_oublie/modele.php");
                include_once ("module/non_connecte/connexion/mdp_oublie/vue.php");

            }
            $this->modele = new Connection();
            $this->vue = new Vue();
        }

        $this->launch();

    }

    function encryptIt( $q ) {
        $cryptKey  = 'qJB0rGtIn5UB1xG03efyCp';
        $qEncoded      = base64_encode( mcrypt_encrypt( MCRYPT_RIJNDAEL_256, md5( $cryptKey ), $q, MCRYPT_MODE_CBC, md5( md5( $cryptKey ) ) ) );
        return( $qEncoded );
    }

    function launch(){
        if(isset($_POST['envoyer'])) {
            if ($this->modele->connexion($_POST['pseudo'], $_POST['motDePasse'])) {

                if (isset($_POST['remember'])) {
                    setcookie('pseudo', $_POST['pseudo'], time() + 3600 * 24 * 365, null, null, true, true);

                    $pass = $this->encryptIt($_POST['motDePasse']);

                    setcookie('mdp', $pass, time() + 3600 * 24 * 365, null, null, true, true);

                    setcookie('type', 'client', time() + 3600 * 24 * 365, null, null, true, true);
                }

                header('Location: https://livesport.onl');

            } else {
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

}