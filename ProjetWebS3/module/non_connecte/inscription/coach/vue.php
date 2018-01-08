<?php


class Vue
{
    private $nav = '';
    private $contenu = '';

    function affichePage($mode = null){

        $this->afficherMenu();

        if($mode == 'debut'){
            $this->signIn();
        }elseif ($mode == 'erreur'){
            $this->contenu .= 'erreur';
        }elseif ($mode == 'dejaPseudo'){
            $this->contenu .= 'Pseudo deja pris';
            $this->signIn();
        }elseif ($mode == 'dejaMail'){
            $this->contenu .= 'Email deja pris';
            $this->signIn();
        }elseif ($mode == 'mail'){
            $this->contenu .= 'Email non-valide';
            $this->signIn();
        }
        include_once ("src/html/page.html");
    }

    function signIn(){
        $this->contenu .= '
            <form action="https://livesport.onl?module=inscription" method="post">
                <label>Nom de compte : </label>
                <input type="text" name="pseudo" placeholder="nom de compte..">
                <label>Mot de passe : </label>
                <input type="password" name="motDePasse" placeholder="mot de passe..">
                <label>Valider le mot de passe : </label>
                <input type="password" name="motDePasse2" placeholder="mot de passe..">
                <label>Adresse Email : </label>
                <input type="text" name="mail" placeholder="mail..">
                <label>Valider l\'adresse Email : </label>
                <input type="text" name="mail2" placeholder="mail..">
                <input type="submit" name="envoyer" value="s\'inscrire">
            </form>
        ';
    }

    function afficherMenu(){
        $this->nav .= '
            <nav>
                <ul>
                    <li><a href="https://livesport.onl">HOME</a></li>
                    <li><a href="https://livesport.onl?module=connexion">Connexion</a></li>
                </ul>
            </nav>
        ';
    }

}