<?php



class Vue
{

    private $nav = '';
    private $contenu = '';

    function affichePage($type, $contenu = null){

        $this->afficheMenu();

        if($type == 'message'){

            $this->afficherMessage($contenu);

        }elseif($type == 'new'){

            $this->afficherNew();

        }elseif($type == 'sujet'){

            $this->afficherSujet($contenu);

        }elseif($type == 'theme'){

            $this->afficherTheme($contenu);

        }

        include_once ("src/html/page.html");

    }

    function afficheMenu(){

        $this->nav .= '
            <h1>Bonjour, '. htmlspecialchars($_SESSION['pseudo']) .'</h1>
            <nav>
                <ul>
                    <li><a href="https://livesport.onl">HOME</a></li>
                    <li><a href="https://livesport.onl?module=profil">Profi</a></li>
                    <li><a href="https://livesport.onl?module=seance">Séances</a></li>
                    <li><a href="https://livesport.onl?module=forum&type=client">Forum</a></li>
                    <li><a href="https://livesport.onl?module=profil&logout">Deconnexion</a></li>
                </ul>
            </nav>
        ';

    }

    function afficherTheme($theme){
        foreach ($theme as $record) {
            $this->contenu .= '
                <div class="theme">
                
                    <h1>' . htmlspecialchars($record['theme_forum']) . '</h1>
                    <p id="description">' . htmlspecialchars($record['description']) . '</p>
                    <a href="https://livesport.onl?module=forum&type=client&theme=' . htmlspecialchars($record['theme_forum']) . '">Entrez</a>
                
                </div>
            ';
        }
    }

    function afficherSujet($contenu){
        $this->contenu .= '
            <h1>'. htmlspecialchars($_GET['theme']) .'</h1>
        ';
        foreach ($contenu as $record){
            $this->contenu .= '
                <div class="sujet">
                    <h4>'. htmlspecialchars($record['nom_sujet']) .'</h4>
                    <p>'. htmlspecialchars($record['debut_premier_message']) .'</p>
                    <a href="https://livesport.onl/?module=forum&type=client&theme='. htmlspecialchars($record['theme_forum']) .'&sujet='. htmlspecialchars($record['id']) .'">Entrez</a>
                </div>
            ';
        }
    }

    function afficherMessage($message){

        $this->contenu .= '
            <h1>'. htmlspecialchars($_GET['theme']) .'</h1>
            <h2>'. htmlspecialchars($_GET['sujet']) .'</h2>
        ';

        foreach($message as $record){

            $this->contenu .= '
                <div class="message">
                    <p>'. $record['date_message'] .'</p>
                    <div class="profil_message_forum">
                        ';

            if($_record['pseudo_coach'] != null){
                $this->contenu .= '
                        <p>'.$record['pseudo_coach'].'</p>
                        <p>Coach</p>
                        <img>
                ';
            }else{
                $this->contenu .= '
                        <p>'.$record['pseudo_client'].'</p>
                        <p>Rang</p>
                        <img>
                ';
            }
            $this->contenu .= '
                    </div>
                    <div>                
                        <p>'. $record['texte_message'] .'</p>
                        <p>'. $record['signature_forum'] .'</p>
                    </div>
                </div>
            ';

        }

    }

}