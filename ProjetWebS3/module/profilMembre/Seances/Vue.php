<?php
/**
 * Created by PhpStorm.
 * User: Denier
 * Date: 27/11/2017
 * Time: 20:41
 */

class Vue
{

    private $nav = '';
    private $contenu = '';

    function affichePage($type, $contenu = null){
        $this->afficherMenu();
        if($type == 'list_seance'){
            $this->afficheListSeance($contenu);
        }elseif ($type == 'list_exercice'){
            $this->afficheListExercice($contenu);
        }elseif($type == 'Submit_seance'){
            $this->RentrerSeance($contenu);
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

    function afficheListSeance($contenu){
        foreach ($contenu as $record) {
            $this->contenu .= '
                <h4><a href="https://livesport.onl?module=seance&seance='. $record['id_seance'] .'">'. $record['nom_seance'] .'</a></h4>
            ';
        }
    }

    function afficheListExercice($contenu){
        foreach ($contenu as $record){

            $charge = explode("-", $record['charge']);
            $rep = explode("-", $record['repetitions']);
            $repos = explode("-", $record['temps_repos']);

            $nb = count($charge);

            $this->contenu .= '
                <h4>'. $record['nom_exercice'] .'</h4>
                <table>
                    <tr>
                        <td>Série</td>
                        <td>charge</td>
                        <td>Répétition</td>
                        <td>Repos</td>
                    </tr>
                ';

            for ($i=0; $i < $nb; $i++) {
                $this->contenu .= '
                    <tr>
                        <td>'.($i+1).'</td>
                        <td>'.$charge[$i].'</td>
                        <td>'.$rep[$i].'</td>
                        <td>'.$repos[$i].'</td>
                    </tr>
                ';
            }

            $this->contenu .= '
                </table>
            ';
        }
        $this->contenu .= '
            <a href="index.php?module=seance&seance='. $_GET['seance'] .'&submit=true">DONE!</a>
        ';
    }

    function RentrerSeance($contenu){
        $this->contenu .= '
            <p>Veuillez rentrer vos perfs pour aider votre coach</p>
            <p>Vous pourrez retrouver vos perfs dans vos seances passé</p>
            <form action="index.php?module=seance&seance='.$_GET['seance'].'" method="post">
        ';
        $j = 0;
        foreach ($contenu as $record){

            $charge = explode("-", $record['charge']);
            $rep = explode("-", $record['repetitions']);
            $repos = explode("-", $record['temps_repos']);

            $nb = count($charge);

            $this->contenu .= '
                <h4>'. $record['nom_exercice'] .'</h4>
                <input type="hidden" name="nom" value="'.$record['nom_exercice'].'">
                <table>
                    <tr>
                        <td>Série</td>
                        <td>charge</td>
                        <td>Répétition</td>
                        <td>Repos</td>
                    </tr>
                ';

            for ($i=0; $i < $nb; $i++) {
                $this->contenu .= '
                    <tr>
                        <td>'.$i.'</td>
                        <td>'.$charge[$i].'</td>
                        <td>'.$rep[$i].'</td>
                        <td>'.$repos[$i].'</td>
                    </tr>
                    <tr>
                        <td></td>
                        <td><input type="text" name="'.$j.'charge'.$i.'"></td>
                        <td><input type="text" name="'.$j.'rep'.$i.'"></td>
                        <td><input type="hidden" name="'.$j.'repos'.$i.'" value="'.$repos[$i].'"></td>
                    </tr>
                ';
            }

            $this->contenu .= '
                </table>
            ';
            $j++;
        }
        $this->contenu .= '
                <label>Commentaire:</label>
                <input type="text" name="commentaire" placeholder="Vous pouvez entrez un commentaire pour cette seance...">
                <input type="submit" name="submit" value="entrer">
            </form>
        ';

    }
    
}