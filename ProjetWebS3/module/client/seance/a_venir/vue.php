<?php



class Vue
{

	private $nav = '';
	private $contenu = '';

	function affichePage($type, $contenu = null){

		$this->afficherMenu();

		if($type == 'listSeance'){

			$this->afficherAside();
			$this->afficheListSeance($contenu);

		}elseif($type == 'listExercice'){

			$this->afficheListExercice($contenu);

		}elseif($type == 'fini'){

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
                    <li><a href="https://livesport.onl?module=seance">Séances</a></li>
                    <li><a href="https://livesport.onl?module=forum">Forum</a></li>
                    <li><a href="https://livesport.onl?module=logout">Deconnexion</a></li>
                </ul>
            </nav>
            <div>
            
                <ul>
                    <li><a href="index.php?module=seance&menu=a_venir">A venir</a></li>
                    <li><a href="index.php?module=seance&menu=passe">Passe</a></li>
                </ul>
            
            </div>
        ';
    }

    function afficherAside(){

        $this->contenu .= '
            <div style="border: 1px solid red">
                    
                <h2>RESUME PROG</h2>
                <ul>
                    <li>COACH: '. $_SESSION['profil']['pseudo_coach'] .'</li>
                    <li>OBJECTIF: '. $_SESSION['profil']['objectif'] .'</li>
                    <li>FREQUENCE: '. $_SESSION['profil']['nb_jour_semaine'] .'</li>
                    <li>TYPE: test</li>
                    <li>MATERIEL: '. $_SESSION['profil']['materiel'] .'</li>
                    <li>PARTIE DU CORPS: test</li>
                </ul>
                
            </div>
        ';

    }

    function afficheListSeance($contenu){

        $this->contenu .= '
            <div>
            
                <h2>PROGRAMME</h2>
                <ul>      
        ';
        foreach ($contenu as $record) {
            $this->contenu .= '
                    <li><span>'. $record['Type_seance'] .'</span> - <span>'. $record['nom_seance'] .'</span> - <span>'. $record['temps_seance'] .'mn</span> - <a href="index.php?module=seance&seance='. $record['id_seance'] .'">DETAILS</a></li>
            ';
        }

        $this->contenu .= '
                </ul>
            </div>
        ';

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
            <a href="index.php?module=seance&seance='. $_GET['seance'] .'&fini=true">DONE!</a>
        ';

    }

}