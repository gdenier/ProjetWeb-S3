<?php



class Controler
{
    private $modele;
    private $vue;

    function __construct()
    {

        if($_GET['type'] == 'client'){
            include_once ("module/non_connecte/inscription/client/modele.php");
            include_once ("module/non_connecte/inscription/client/vue.php");
        }else{
            include_once ("module/non_connecte/inscription/coach/modele.php");
            include_once ("module/non_connecte/inscription/coach/vue.php");
        }

        $this->modele = new Modele();
        $this->vue = new Vue();

        $this->launch();

    }

    function launch(){
        if(isset($_POST['envoyer'])){
            $good = $this->modele->VerifDouble($_POST['pseudo'], $_POST['mail']);

            if($good == 'pseudo'){

                $this->vue->affichePage('dejaPseudo');

            }elseif($good == 'mail'){

                $this->vue->affichePage('dejaMail');

            }else{

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