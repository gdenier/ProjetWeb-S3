<?php
/**
 * Created by PhpStorm.
 * User: Denier
 * Date: 05/11/2017
 * Time: 15:07
 */

class Vue
{

    private $contenu = '';

    function affichePage($mode, $theme = null, $contenu = null){
        switch ($mode){
            case 'acceuil':

                break;
            case 'sujet':

                break;
            case '':

                break;
        }

        if($contenu == null){
            $this->afficheMenu($theme);
            include_once ("src/html/page.html");
        }else{
            $this->afficheSujet($theme, $contenu);
            include_once ("src/html/page.html");
        }
    }

    function afficheMenu($theme){
        foreach ($theme as $record) {
            $this->contenu .= '
                <div id="theme">
                
                    <h1>' . $record['theme'] . '</h1>
                    <p id="description">' . $record['description'] . '</p>
                    <a href="https://livesport.onl?module=forum&theme=' . $record['theme'] . '">Entrez</a>
                
                </div>
            ';
        }
    }

    function afficheSujet($theme, $contenu){
        $this->contenu .= '
            <h1>'. $theme .'</h1>
        ';

        foreach ($contenu as $record){
            $this->contenu .= '
                <div id="sujet">
                    <h4>'. $record['nom_sujet'] .'</h4>
                    <p>'. $record['description'] .'</p>
                    <a href="https://livesport.onl/?module=forum&theme=Programmes&sujet='. $record['id'] .'">Entrez</a>
                </div>
            ';
        }
    }
}