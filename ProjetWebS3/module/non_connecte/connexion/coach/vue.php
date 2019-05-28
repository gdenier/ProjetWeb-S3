<?php

class Vue
{

    private $nav = '';
    private $contenu = '';

    function affichePage($mode = null, $contenu = null){

        $this->afficherMenu();

        if($mode == 'debut'){
            $this->logIn();
        }elseif ($mode == 'erreur'){
            $this->contenu .= 'erreur';
        }
        include_once ("src/html/page.html");
    }

    function logIn(){
        $this->contenu .= '
            <form action="https://livesport.onl?module=connexion&type=coach" method="post">
                <label>Entrez votre pseudo ou adresse Email : </label>
                <input type="text" name="pseudo" placeholder="pseudo ou adresse email..">
                <label>Mot de passe : </label>
                <input type="password" name="motDePasse" placeholder="mot de passe..">
                <input type="checkbox" name="remember"><label>Remember me</label>
                <input type="submit" name="envoyer" value="Connexion">
            </form>

                <a href="index.php?module=connexion&recup_mdp=true">oublie de mot de passe</a>
        ';
    }

    function afficherMenu(){
        $this->nav .= '
            <nav>
                <ul>
                    <li><a href="https://livesport.onl">HOME</a></li>
                    <li><a href="https://livesport.onl?module=inscription">Inscription</a></li>
                </ul>
            </nav>
        ';
    }

}