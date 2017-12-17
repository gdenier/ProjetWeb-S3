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

    function affichePage(){

        $this->afficheMenu();
        include_once ("src/html/page.html");

    }

    function afficheMenu(){
        $this->contenu .='
        
        <header>
	
		<a href="https://livesport.onl"> <img id="img_logo" src="src/img/logo.jpg" alt="Logo de mon site"></a>
		<nav class="nav">
			<ul>
				<li><a href="https://livesport.onl?module=inscription">GET STARTED</a></li>
				<li id="sign"><a  href="https://livesport.onl?module=connexion">SIGN IN</a></li>
			</ul>
		</nav>
		<ul id="menu-deroulant">
	
			<li><a href="#"><img id="img_menu" src="src/img/menu.jpg" alt="menu du site"></a>
				<ul>
					<li id=premier_lien_defile><a href="#">Page 1</a></li>
					<li><a href="#">Page 2</a></li>
					<li><a href="#">Page 3</a></li>
				</ul>
			</li>
	
		</ul>
	
	</header>
	<!-- Barre de navigation -->
	
	
	<!-- Partie principale de la page d\'accueil -->
	
	<section>

		<!-- Articles principaux -->
		<div id="premier_div">
			<div id="premier_bloc_premier_div">
				<div class="sous_div">
					<h4>Comme d\'hab</h4>
					<p>Our goal ils simple. Give FwH\'s professional and new comers the opportunities to complete in quality events.</p>
					<a href="#"><input type="button" value="+" class="plus"> </a>
				</div>
				<img id="curl_barre" src="src/img/curl_barre.jpg" alt="curl biceps barre">
			</div>
			<div id="deuxieme_bloc_premier_div">
				<img id="course" src="src/img/course.jpg" alt="femme qui court">
				<div class="sous_div">
					<h4>Inspirational Fitness Tips</h4>
					<p>Working from home meant we could vary snack and coffe breaks, change our deskc or view, goof off, drink on the job, even ...</p>
					<a href="#"><input type="button" value="+" class="plus"> </a>
				</div>	
			</div>
		</div>

		<div id="deuxieme_div">
			<h1>TOTALLY FREE</h1>
			<table>
			
				<td id="premiere_colonne_tableau">
					<h4> Workout</h4>
					<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc eget lorem viverra, ullamcorper eros et, auctor lectus. Aliquam condimentum ullamcorper diam eget sagittis.</p>
				</td>
			
				<td id="deuxieme_colonne_tableau" background="src/img/cardio.jpg"  background-size= 100%>
<!-- 				<img id="img4" src="src/img/img4.jpg" alt="curl biceps halteres"> -->
					<img id="img5" src="src/img/img5.jpg" alt="logo coeur cardio">
					<p>Cardio</p>
				</td>
				
				<td id="troisieme_colonne_tableau" background="src/img/sprinter.jpg"  background-size=100%>
					<img id="img6" src="src/img/img6.jpg" alt="logo sprint">
					<h4>Outdoor Exercise</h4>
					<p>Lorem ipseum dolor sit amet, consect tur adipisicing elit, sef do eiusmod tempor incididunt ut labore et dolore magna alique ...</p>
					<a href="#"><input type="button" value="READ MORE" id="read_more"> </a>
				</td>
			</table>

		</div>

		<div id="troisieme_div">
			<img id="lacets" src="src/img/lacets.jpg" alt="fait ses lacets">
			<div class="sous_div">
				<h4>Workout of the day</h4>
				<p>Working from home ment ce coukd vary snack and coffe breaks, change our desks or view, goof off, drink on the job, even ...</p>
				<a href="#"><input type="button" value="+" class="plus"> </a>
			</div>
		</div>
	
		
	</section>
		
	<!-- Retour en haut -->
<!-- 	<a href="index.html" onmouseover="changeFlecheHautnoir()" onmouseout="changeFlecheHautgris()"><img src="src/img/flechehautgris.png" alt="fleche de retour en haut de page" id="flechehaut"/></a>
	 -->
	
	<!--Footer de la page -->
	<footer>
		
		<div id ="premier_div_footer">
			<h4>Fit and Healthy</h4>
			<p>Fit and Healthy Produtions c 2016. All Rigths Reserved.</p>
		</div>

		<nav class="nav">
			<ul>
			  	<li><a href="https://livesport.onl">HOME</a></li>
				<li><a href="#">ABOUT</a></li>
				<li><a href="#">CLASSES</a></li>
				<li><a href="#">TIMETABLE</a></li>
				<li id=derniere_colonne><a href="#">PRICING</a></li>
			</ul>	
		</nav>
	

	</footer>
	
        
        ';
    }

}

