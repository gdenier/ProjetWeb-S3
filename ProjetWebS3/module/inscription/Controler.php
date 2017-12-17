<?php
/**
 * Created by PhpStorm.
 * User: Denier
 * Date: 11/11/2017
 * Time: 15:00
 */

include_once ("module/inscription/Modele.php");
include_once ("module/inscription/Vue.php");

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

            if($this->modele->VerifDouble($_POST['pseudo'], $_POST['mail']) == 'pseudo'){
                $this->vue->affichePage('dejaPseudo');
            }elseif($this->modele->VerifDouble($_POST['pseudo'], $_POST['mail']) == 'mail'){
                $this->vue->affichePage('dejaMail');
            }else {
                if($this->modele->verifMail($_POST['mail'])){
                    if ($this->modele->inscription()) {

                        $_SESSION['pseudo'] = $_POST['pseudo'];
                        $_SESSION['type'] = 'client';

                        header('Location: https://livesport.onl');
                    } else {
                        $this->vue->affichePage('erreur');
                    }
                }else{
                    $this->vue->affichePage('mail');
                }

            }
        }else{
            $this->vue->affichePage('debut');
        }

    }
}