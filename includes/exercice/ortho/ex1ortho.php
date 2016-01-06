<?php
	if( !isset($_GET['act']) )
	{
		$mess_text1 = null;
	}
	else
	{
		$fic_resultat = 'includes/fichiers/'.$_SESSION['pseudo'].'/resultat.ini';
	
		// Création du tableau resultat
		$resultat=array();
	
		// On vérifie si le fichier existe et si on arrive à le lire
		if(file_exists($fic_resultat) && $fic_resultat_lecture=file($fic_resultat))
		{
			
			foreach($fic_resultat_lecture as $ligne)
			{
				@list($info,$valeur) = explode(" = ", $ligne, 2 );
				$resultat[$info] = $valeur;
			}
			
			$resultat['Nb_ortho'] += 1;
			
		}
		

		$res = 0;
	}
	
	$mot1_color = 'white';
	$mot2_color = 'white';
	$mot3_color = 'white';
	$mot4_color = 'white';
	$mot5_color = 'white';
	$mot6_color = 'white';
	$mot7_color = 'white';
	$mot8_color = 'white';
	$mot9_color = 'white';
	$mot10_color = 'white';
	
	if( isset($_POST['mot1']) )
	{
		$mot1 = $_POST['mot1'];
		
		if( $mot1 == 'universitaire' )
		{
			$mot1_color = 'green';
			$mot1 = 'ok';
			
			$res += 1;
		}
		else
		{
			$mot1_color = 'red';
			$mot1 = 'ok';
		}
	}
	if( isset($_POST['mot2']) )
	{
		$mot2 = $_POST['mot2'];
		
		if( $mot2 == 'baptisé' )
		{
			$mot2_color = 'green';
			$mot2 = 'ok';
			
			$res += 1;
		}
		else
		{
			$mot2_color = 'red';
			$mot2 = 'ok';
		}
	}	
	if( isset($_POST['mot3']) )
	{
		$mot3 = $_POST['mot3'];
		
		if( $mot3 == 'commercialisation' )
		{
			$mot3_color = 'green';
			$mot3 = 'ok';
			
			$res += 1;
		}
		else
		{
			$mot3_color = 'red';
			$mot3 = 'ok';
		}
	}
	if( isset($_POST['mot4']) )
	{
		$mot4 = $_POST['mot4'];
		
		if( $mot4 == 'sensitives' )
		{
			$mot4_color = 'green';
			$mot4 = 'ok';
			
			$res += 1;
		}
		else
		{
			$mot4_color = 'red';
			$mot4 = 'ok';
		}
	}
	if( isset($_POST['mot5']) )
	{
		$mot5 = $_POST['mot5'];
		
		if( $mot5 == 'digital' )
		{
			$mot5_color = 'green';
			$mot5 = 'ok';
			
			$res += 1;
		}
		else
		{
			$mot5_color = 'red';
			$mot5 = 'ok';
		}
	}
	if( isset($_POST['mot6']) )
	{
		$mot6 = $_POST['mot6'];
		
		if( $mot6 == 'intégrée' )
		{
			$mot6_color = 'green';
			$mot6 = 'ok';
			
			$res += 1;
		}
		else
		{
			$mot6_color = 'red';
			$mot6 = 'ok';
		}
	}
	if( isset($_POST['mot7']) )
	{
		$mot7 = $_POST['mot7'];
		
		if( $mot7 == 'transmissions' )
		{
			$mot7_color = 'green';
			$mot7 = 'ok';
			
			$res += 1;
		}
		else
		{
			$mot7_color = 'red';
			$mot7 = 'ok';
		}
	}
	if( isset($_POST['mot8']) )
	{
		$mot8 = $_POST['mot8'];
		
		if( $mot8 == 'détectent' )
		{
			$mot8_color = 'green';
			$mot8 = 'ok';
			
			$res += 1;
		}
		else
		{
			$mot8_color = 'red';
			$mot8 = 'ok';
		}
	}
	if( isset($_POST['mot9']) )
	{
		$mot9 = $_POST['mot9'];
		
		if( $mot9 == 'indépendante' )
		{
			$mot9_color = 'green';
			$mot9 = 'ok';
			
			$res += 1;
		}
		else
		{
			$mot9_color = 'red';
			$mot9 = 'ok';
		}
	}
	if( isset($_POST['mot10']) )
	{
		$mot10 = $_POST['mot10'];
		
		if( $mot10 == 'effectue' )
		{
			$mot10_color = 'green';
			$mot10 = 'ok';
			
			$res += 1;
		}
		else
		{
			$mot10_color = 'red';
			$mot10 = 'ok';
		}
	}

	if( isset($_GET['act']) )
	{
		$res = ($res/10)*100;
		$pt_ex = round(100*$res)/100;
		
		$res = $resultat['Orthographe'] + $res;
		
		$resultat['Orthographe'] = $res;
		
		$resultat['Pourc_ortho'] = $resultat['Orthographe'] / $resultat['Nb_ortho'];
		
		
		// On crée l'entrée a enregistrer dans le fichier
		$fichier_save="";

		// On parcours l'array en sauvegardant la clé et la valeur correspondant
		foreach($resultat as $cle => $valeur)
		{
			// On ajoute la ligne <clé> = <valeur>
			$fichier_save.="\n".$cle." = ".$valeur."\n";
		}
		// On ajoute le tout dans le fichier en écrasant le fichier auparavant
		file_put_contents($fic_resultat, $fichier_save);

		//On ferme le fichier
		@fclose($fic_resultat);
	}
	if( isset($mot1) && isset($mot2) && isset($mot3) && isset($mot4) && isset($mot5) && isset($mot6) && isset($mot7) && isset($mot8) && isset($mot9) && isset($mot10) )
	{
		if( $pt_ex == 100 )
		{	
			$mess_text = 'Excellent !';
		}
		if( $pt_ex >= 70 && $pt_ex < 100 )
		{
			$mess_text = 'Très Bien !';
		}
		if( $pt_ex >= 50 && $pt_ex < 70 )
		{
			$mess_text = 'Pas mal, mais peux mieux faire !';
		}
		if( $pt_ex >= 30 && $pt_ex < 50 )
		{
			$mess_text = 'Insuffisant !';
		}
		if( $pt_ex >= 0 && $pt_ex < 30 )
		{	
			$mess_text = 'Ce n\'est pas bien du tout !';
		}
		$text = 'ok';
	}
	
?><?php	
	echo '<div id="content">';
	echo '	<div class="content">';
	echo '		<ul>';
	echo '			<li>';	
	echo '				<form method="post" action="index.php?page=exe&type=ortho&exe=1&act=cor">';
						if( isset($text) && $text == "ok" )
						{
	echo ' Dans les années 60, un <font color="'.$mot1_color.'">universitaire</font> d\'Illinois imagine un écran tactile à technologie infrarouge, permettant aux étudiants de son université de répondre à des questionnaires en'; 
	echo ' touchant l\'écran d\'un ordinateur. Ce projet est <font color="'.$mot2_color.'">baptisé</font> PLATO (Programmed Logic for Automated Teaching Operations) et aboutira par la <font color="'.$mot3_color.'">commercialisation</font> par IBM du prototype PLATO IV ';
	echo ' en 1972, possédant une surface de 16x16 zones <font color="'.$mot4_color.'">sensitives</font>. C\'est le premier écran tactile qui fut mis sur le marché et avança sur la première marche de cette technologie qui ';
	echo ' aujourd\'hui fait partie intégrante de notre vie.<br>';
	echo ' En 1979, la Fairlight CMI (Computer Musical Instrument), un synthétiseur <font color="'.$mot5_color.'">digital</font>, fut créé par Peter Vogel et Kim Ryrie. Le modèle évolua pour passer d\'un système de stylo lumineux à'; 
	echo ' une tablette graphique <font color="'.$mot6_color.'">intégrée</font> dans le clavier, le stylo lumineux semblant être l\'élément le plus fragile du système. La compagnie Fairlight fit faillite quelques années plus tard, ';
	echo ' ne pouvant 	rentrer dans ses frais vu le prix très couteux des composants du synthétiseur.';
	echo ' Le HP-150 de 1983 (Hewlett & Packard) fut l\'un des ordinateurs à écran tactile le plus facilement commercialisable au monde. Similaire au système du PLATO IV, la technologie tactile ';
	echo ' emploie des <font color="'.$mot7_color.'">transmissions</font> infrarouges qui <font color="'.$mot8_color.'">détectent</font> la position de chaque objet non transparent sur l\'écran. La machine n\'était pas compatible avec les PC IBM, cependant elle l\'était ';
	echo ' avec MS-DOS. La société Bell Labs créa le premier écran multi-touch en 1984, suite aux travaux de Nimish Mehta, chercheur à l\'université de Toronto. Il s\'agit d\'un dispositif tactile ';
	echo ' multi-touch couplé à un dispositif d\'affichage.<br>';
	echo ' Le premier écran bi-manuel  fait son apparition en 1986, dans cette même université de Toronto. Le dispositif est contrôlé par deux mains, de façon simultanée, mais <font color="'.$mot9_color.'">indépendante</font>. ';
	echo ' L\'une des mains <font color="'.$mot10_color.'">effectue</font> les tâches de disposition et de mise à l\'échelle, tandis que la seconde se charge de la sélection et de la navigation. L\'envie de pouvoir gérer l\'écran avec ';
	echo ' ses deux mains commence à se faire sentir.<br>';
						}
						else
						{
	echo ' Dans les années 60, un'; 
	echo ' <select class="select" name="mot1" size="1">'; 
	echo ' <option>universitaire</option>';
	echo ' <option>universitère</option>';
	echo ' <option>univairsitaire</option>';
	echo ' <option>univairsitère</option>';
	echo ' </select>'; 
	echo ' d\'Illinois imagine un écran tactile à technologie infrarouge, permettant aux étudiants de son université de répondre à des questionnaires en'; 
	echo ' touchant l\'écran d\'un ordinateur. Ce projet est ';
	echo ' <select class="select" name="mot2" size="1">'; 
	echo ' <option>batiser</option>';
	echo ' <option>baptisé</option>';
	echo ' <option>baptiser</option>';
	echo ' <option>batisé</option>';
	echo ' </select>'; 
	echo ' PLATO (Programmed Logic for Automated Teaching Operations) et aboutira par la ';
	echo ' <select class="select" name="mot3" size="1">'; 
	echo ' <option>comersilisasion</option>';
	echo ' <option>commersialisation</option>';
	echo ' <option>comercialisation</option>';
	echo ' <option>commercialisation</option>';
	echo ' </select>'; 
	echo ' par IBM du prototype PLATO IV en 1972, possédant une surface de 16x16 zones ';
	echo ' <select class="select" name="mot4" size="1">'; 
	echo ' <option>sensitive</option>';
	echo ' <option>sansitive</option>';
	echo ' <option>sensitives</option>';
	echo ' <option>sansitives</option>';
	echo ' </select>'; 
	echo '. C\'est le premier écran tactile qui fut mis sur le marché et avança sur la première marche de cette technologie qui ';
	echo ' aujourd\'hui fait partie intégrante de notre vie.<br>';
	echo ' En 1979, la Fairlight CMI (Computer Musical Instrument), un synthétiseur';
	echo ' <select class="select" name="mot5" size="1">'; 
	echo ' <option>digitale</option>';
	echo ' <option>digitalle</option>';
	echo ' <option>digital</option>';
	echo ' </select>'; 
	echo ', fut créé par Peter Vogel et Kim Ryrie. Le modèle évolua pour passer d\'un système de stylo lumineux à'; 
	echo ' une tablette graphique';
	echo ' <select class="select" name="mot6" size="1">'; 
	echo ' <option>integrée</option>';
	echo ' <option>intégrée</option>';
	echo ' <option>intègré</option>';
	echo ' <option>intégrer</option>';
	echo ' </select>'; 
	echo ' dans le clavier, le stylo lumineux semblant être l\'élément le plus fragile du système. La compagnie Fairlight fit faillite quelques années plus tard, ';
	echo ' ne pouvant 	rentrer dans ses frais vu le prix très couteux des composants du synthétiseur.';
	echo ' Le HP-150 de 1983 (Hewlett & Packard) fut l\'un des ordinateurs à écran tactile le plus facilement commercialisable au monde. Similaire au système du PLATO IV, la technologie tactile ';
	echo ' emploie des';
	echo ' <select class="select" name="mot7" size="1">'; 
	echo ' <option>transmissions</option>';
	echo ' <option>transmitions</option>';
	echo ' <option>trensmissions</option>';
	echo ' </select>'; 	
	echo ' infrarouges qui'; 
	echo ' <select class="select" name="mot8" size="1">'; 
	echo ' <option>détaictent</option>';
	echo ' <option>détectent</option>';
	echo ' <option>détectes</option>';
	echo ' </select>'; 
	echo ' la position de chaque objet non transparent sur l\'écran. La machine n\'était pas compatible avec les PC IBM, cependant elle l\'était ';
	echo ' avec MS-DOS. La société Bell Labs créa le premier écran multi-touch en 1984, suite aux travaux de Nimish Mehta, chercheur à l\'université de Toronto. Il s\'agit d\'un dispositif tactile ';
	echo ' multi-touch couplé à un dispositif d\'affichage.<br>';
	echo ' Le premier écran bi-manuel  fait son apparition en 1986, dans cette même université de Toronto. Le dispositif est contrôlé par deux mains, de façon simultanée, mais.';
	echo ' <select class="select" name="mot9" size="1">'; 
	echo ' <option>indépandente</option>';
	echo ' <option>indépendente</option>';
	echo ' <option>indépendante</option>';
	echo ' <option>indépandante</option>';
	echo ' </select>'; 
	echo ' . L\'une des mains'; 
	echo ' <select class="select"  name="mot10" size="1">'; 
	echo ' <option>effectue</option>';
	echo ' <option>effectuent</option>';
	echo ' <option>éfectues</option>';
	echo ' <option>effectues</option>';
	echo ' </select>'; 
	echo ' les tâches de disposition et de mise à l\'échelle, tandis que la seconde se charge de la sélection et de la navigation. L\'envie de pouvoir gérer l\'écran avec ';
	echo ' ses deux mains commence à se faire sentir.<br>';
						}
						if( isset($mess_text) && $mess_text != '' )
						{
	echo '				<div class="message">';
	echo 					$mess_text;
	echo '				</div>';
						}
	echo '			</li>';
	echo '			<li>';
	echo '			<br><br>';
						if( !isset($_GET['act']) )
						{
	echo '					<input class="bouton" type="submit" name="valider" value="Correction" />';
						}
						else
						{
	echo '					Résultat : '.$pt_ex.'%';
						}
	echo '			</li>';
	echo '		</ul>';
	echo '	</div>';
	echo '</div>';
?>