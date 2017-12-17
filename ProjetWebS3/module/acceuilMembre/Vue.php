<?php
/**
 * Created by PhpStorm.
 * User: Denier
 * Date: 11/11/2017
 * Time: 15:00
 */

class Vue
{
    private $nav = '';
    private $contenu = '';

    function affichePage($mode = null){

        $this->afficherMenu();
        if($mode == null) {
            $this->afficherTableauBord();
        }elseif($mode == 'first'){
            $this->afficherPremiereCo();
        }

        include_once ("src/html/page.html");

    }

    function afficherMenu(){
        $this->nav .= '
            <h1>Bonjour, '. $_SESSION['pseudo'] .'</h1>
            <nav>
                <ul>
                    <li><a href="https://livesport.onl">HOME</a></li>
                    <li><a href="https://livesport.onl?module=profil">Profil</a></li>
                    <li><a href="https://livesport.onl?module=seance">Séances</a></li>
                    <li><a href="https://livesport.onl?module=forum">Forum</a></li>
                    <li><a href="https://livesport.onl?module=logout">Deconnexion</a></li>
                </ul>
            </nav>
        ';
    }

    function afficherTableauBord(){
        $this->contenu .= '
            <div id="stat">
                <p>Stat à choisir</p>
            </div>
            
            <div id="seance_pro">
                <p>Prochaine Séance</p>
            </div>
            
            <div id="last_forum">
                <p>Derniers messages du forums</p>
            </div>
        ';
    }

    function afficherPremiereCo(){
        $this->contenu .= '
            <h2>Compléter les information personnelles</h2>
			<form action="https://livesport.onl" method="POST" class="grid-2 w30">
                <label>Nom : </label>
                    <input type="text" name="nom">
                <label>Prenom : </label>
                    <input type="text" name="prenom">
                <label>Age : </label>
                    <input type="text" name="age">
                <label>Sexe : </label>
                    <select name="sexe">
                        <option value="feminin">féminin
                        <option>masculin
                    </select>
                <label>Poids(en kg) : </label>
                    <input type="text" name="poids">
                <label>Taille(en cm) : </label>
                    <input type="text" name="taille">
                <label>Objectif : </label>
                    <select name="objectif">
                        <option>entretien
                        <option value="perte de poids">perte de poids
                        <option value="gain de masse">gain de masse musculaire
                    </select>
                <label>Nombre de jours par semaine : </label>
                    <select name="materiel">
                        <option value="1">1
                        <option value="2">2
                        <option value="3">3
                        <option value="4">4
                        <option value="5">5
                        <option value="6">6
                        <option value="7">7
                    </select>
                <label>Materiel a votre disposition : </label>
                    <select name="materiel">
                        <option value="aucun">Aucun
                        <option value="haltères et banc">Des haltères et un banc
                        <option value="salle de sport">Je suis dans une salle de sport
                    </select>
                <input type="submit" name="firstCo" value="envoyer">
            </form>
        ';
    }

}