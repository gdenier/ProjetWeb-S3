<?php
/**
 * Created by PhpStorm.
 * User: Denier
 * Date: 05/11/2017
 * Time: 15:07
 */

include_once("module/forum/Modele.php");
include_once("module/forum/Vue.php");

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
        if(isset($_GET['theme'])){
            switch ($_GET['theme']){
                case 'Programmes':
                    if(!isset($_GET['sujet'])) {
                        $contenu = $this->modele->recupSujet(1);
                        $this->vue->affichePage('Programmes', $contenu);
                    }else{
                        $contenu = $this->modele->recupMessage(1, $_GET['sujet']);
                        $this->vue->affichePage(1, $contenu);
                    }
                    break;
                default:

                    break;
            }
        }else{
            $theme = $this->modele->recupTheme();
            $this->vue->affichePage($theme);
        }
    }
}