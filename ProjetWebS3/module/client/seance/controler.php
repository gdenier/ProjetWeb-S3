<?php



class controler
{

	private $modele;
	private $vue;

	function __construct(){

		if($_GET['menu'] == 'passe'){
            include_once ("module/client/seance/passe/modele.php");
            include_once ("module/client/seance/passe/modele.php");
		}else{
            include_once ("module/client/seance/a_venir/modele.php");
            include_once ("module/client/seance/a_venir/vue.php");
		}

		$this->modele = new Modele();
		$this->vue = new Vue();

		$this->launch();
	}

	function launch(){

		if(!isset($_GET['seance'])){
			$liste = $this->modele->listSeance();
			$this->vue->affichePage('listSeance', $liste);

		}else{

			if(isset($_GET['fini'])){

				$liste = $this->modele->listExercice();
				$this->vue->affichePage('fini', $liste);

			}elseif(isset($_POST['submit'])){

				$this->modele->rentrer_stat();
                $this->modele->suppSeance();

                header("https://livesport.onl?module=seance");

			}else{

				$liste = $this->modele->listExercice();
				$this->vue->affichePage('listExercice' ,$liste);

			}

		}

	}

}