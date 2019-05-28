<?php



class Vue
{
    private $nav = '';
    private $contenu = '';

    function affichePage($mode = null, $contenu = null){

        $this->afficherMenu();

        if ($mode == 'oublie'){
            $this->oublieMDP();
        }elseif($mode == 'attente'){
            $this->OublieMDPAttente($contenu);
        }elseif($mode == 'changement'){
            $this->changementMDP($contenu);
        }
        include_once ("src/html/page.html");

    }

    function oublieMDP(){
        $this->contenu .='
            <div>
                <p>Indiquez votre email, si elle correspond a une deja enregistrer un lien de reset vous sera envoyer sur cette derniere</p>
                <form action="index.php?module=connexion&recup_mdp=on" method="post">
                    
                    <input type="email" name="email" placeholder="indiquez votre Email">
                    <input type="submit" name="done" value="Envoyer">
                    
                </form>
            </div>
        ';
    }

    function OublieMDPAttente($email){
        $this->contenu .= '
            <div>
                <p>Un email vous a été envoyé a l\'adresse, '. $email .'</p>
                <p> Si dans 5 min vous n\'avez toujours rien reçu, vous pouvez demander un nouvel email</p>
                <form action="index.php?module=connexion&recup_mdp=on" method="post">
                    <input type="submit" name="done" value="demander un autre email">
                    <input type="hidden" name="email" value="'. $email .'">
                </form>
            </div>
        ';
    }

    function changementMDP(){
        $this->contenu .= '
            <div>
            
                <form action="index.php?module=connexion&recup_mdp=out" method="post">
                    
                    <input type="password" name="pass" placeholder="Entrez un nouveau mdp">
                    <input type="password" name="pass2" placeholder="validez votre mdp">
                    <input type="submit" name="submit" value="Envoyer">
                    
                </form>
            
            </div>
        ';
    }

}