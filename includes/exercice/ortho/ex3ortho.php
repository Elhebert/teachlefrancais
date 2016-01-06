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
		
		if( $mot1 == 'a' )
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
		
		if( $mot2 == 'spécifiquement' )
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
		
		if( $mot3 == 'recueillir' )
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
		
		if( $mot4 == 'traiter' )
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
		
		if( $mot5 == 'parallèle' )
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
		
		if( $mot6 == 'appuyé' )
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
		
		if( $mot7 == 'rayonnement' )
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
		
		if( $mot8 == 'inférieur' )
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
		
		if( $mot9 == 'reflètès' )
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
		
		if( $mot10 == 'quatre cents' )
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
?>
<?php
	echo '<div id="content">';
	echo '	<div class="content">';
	echo '		<ul>';
	echo '			<li>';
	echo '				<form method="post" action="index.php?page=exe&type=ortho&exe=3&act=cor">';
						if( isset($text) && $text == "ok" )
						{
	echo ' De nombreuses façons existent pour créer une table multi-touch, mais nous avons choisi de vous expliquer en détail le fonctionnement de l’écran FTIR (frustrated total internal reflection ';
	echo ' / réflexion totale interne). Comme dit dans l’historique, le FTIR a été conçu par Jefferson Han en 2005, et lui <font color="'.$mot1_color.'">a</font> permis de créer un « mur » tactile. Le FTIR est composé de trois composants ';
	echo ' vitaux : une plaque de plexiglas, une chaine de LEDs infrarouges et une caméra infrarouge <font color="'.$mot2_color.'">spécifiquement</font> conçue pour capter les rayons. Les autres composants sont : Des résistances qui sont ';
	echo ' chargées d’alimenter les LEDs, un écran de projection, qui va <font color="'.$mot3_color.'">recueillir</font> l’image du projecteur, un projecteur, de la silicone qui sert de pont entre la plaque et le doigt, un filtre lumière ';
	echo ' et un ordinateur pour <font color="'.$mot4_color.'">traiter</font> l’image envoyée par la caméra. Les LEDs sont disposées tout autour de la plaque de plexiglas de telle façon qu’elles rayonnent de façon continue dans ';
	echo ' l’infrarouge. Une fois que la lumière infrarouge est à l\'intérieur du plexiglas, elle frappe les surfaces supérieures et inférieures sous un angle presque <font color="'.$mot5_color.'">parallèle</font>, et est soumise à un effet ';
	echo ' de réflexion interne. Des rayons parcourent alors l\'ensemble de la plaque de plexiglas. Lorsque le doigt est <font color="'.$mot6_color.'">appuyé</font> sur la plaque, il va diffuser le <font color="'.$mot7_color.'">rayonnement</font> dans toutes les ';
	echo ' directions, et certains de ces rayons déviés vont toucher la surface <font color="'.$mot8_color.'">inférieure</font> de la plaque sous un angle leur permettant d’en sortir. Ces rayons vont former un point lumineux infrarouge, ';
	echo ' qui sera détecté par la caméra spéciale située en dessous. Voici une image qui représente une webcam qui a été modifiée pour ne détecter que la lumière infrarouge, représentant les points de ';
	echo ' lumière <font color="'.$mot9_color.'">reflétés</font> par des points blancs sur l’écran. Une telle table peut être créée de façon personnelle, les différents composants pouvant se trouver sur le marché. Mais le budget à prévoir ';
	echo ' est d’à peu près <font color="'.$mot10_color.'">quatre cents</font> euros.';
						}
						else
						{
	echo ' De nombreuses façons existent pour créer une table multi-touch, mais nous avons choisi de vous expliquer en détail le fonctionnement de l’écran FTIR (frustrated total internal reflection ';
	echo ' / réflexion totale interne). Comme dit dans l’historique, le FTIR a été conçu par Jefferson Han en 2005, et lui ';
	echo ' <select class="select" name="mot1" size="1">'; 
	echo ' <option>à</option>';
	echo ' <option>a</option>';
	echo ' <option>as</option>';
	echo ' </select>'; 
	echo ' permis de créer un « mur » tactile. Le FTIR est composé de trois composants ';
	echo ' vitaux : une plaque de plexiglas, une chaine de LEDs infrarouges et une caméra infrarouge ';
	echo ' <select class="select" name="mot2" size="1">'; 
	echo ' <option>spécifiquemment</option>';
	echo ' <option>spécificement</option>';
	echo ' <option>spéssifiquement</option>';
	echo ' <option>spécifiquement</option>';
	echo ' </select>'; 
	echo 'conçue pour capter les rayons. Les autres composants sont : Des résistances qui sont ';
	echo ' chargées d’alimenter les LEDs, un écran de projection, qui va ';
	echo ' <select class="select" name="mot3" size="1">'; 
	echo ' <option>recueillir</option>';
	echo ' <option>recueilir</option>';
	echo ' <option>receillir</option>';
	echo ' <option>receilir</option>';
	echo ' </select>'; 
	echo ' l’image du projecteur, un projecteur, de la silicone qui sert de pont entre la plaque et le doigt, un filtre lumière ';
	echo ' et un ordinateur pour ';
	echo ' <select class="select" name="mot4" size="1">'; 
	echo ' <option>traîter</option>';
	echo ' <option>traîté</option>';
	echo ' <option>traiter</option>';
	echo ' <option>traité</option>';
	echo ' </select>'; 
	echo ' l’image envoyée par la caméra. Les LEDs sont disposées tout autour de la plaque de plexiglas de telle façon qu’elles rayonnent de façon continue dans ';
	echo ' l’infrarouge. Une fois que la lumière infrarouge est à l\'intérieur du plexiglas, elle frappe les surfaces supérieures et inférieures sous un angle presque ';
	echo ' <select class="select" name="mot5" size="1">'; 
	echo ' <option>parrallèle</option>';
	echo ' <option>parallèle</option>';
	echo ' <option>parrallele</option>';
	echo ' <option>parallele</option>';
	echo ' </select>'; 
	echo ' , et est soumise à un effet ';
	echo ' de réflexion interne. Des rayons parcourent alors l\'ensemble de la plaque de plexiglas. Lorsque le doigt est'; 
	echo ' <select class="select" name="mot6" size="1">'; 
	echo ' <option>appuyer</option>';
	echo ' <option>appuié</option>';
	echo ' <option>appuier</option>';
	echo ' <option>appuyé</option>';
	echo ' </select>'; 
	echo ' sur la plaque, il va diffuser le ';
	echo ' <select class="select" name="mot7" size="1">'; 
	echo ' <option>rayonement</option>';
	echo ' <option>rayonnement</option>';
	echo ' <option>rayonnemment</option>';
	echo ' </select>'; 
	echo 'dans toutes les ';
	echo ' directions, et certains de ces rayons déviés vont toucher la surface';
	echo ' <select class="select" name="mot8" size="1">'; 
	echo ' <option>inferieur</option>';
	echo ' <option>inférieur</option>';
	echo ' <option>infèrieur</option>';
	echo ' <option>infêrieur</option>';
	echo ' </select>'; 
	echo ' de la plaque sous un angle leur permettant d’en sortir. Ces rayons vont former un point lumineux infrarouge, ';
	echo ' qui sera détecté par la caméra spéciale située en dessous. Voici une image qui représente une webcam qui a été modifiée pour ne détecter que la lumière infrarouge, représentant les points de ';
	echo ' lumière ';
	echo ' <select class="select" name="mot9" size="1">'; 
	echo ' <option>refleter</option>';
	echo ' <option>refléter</option>';
	echo ' <option>reflétés</option>';
	echo ' <option>refletés</option>';
	echo ' </select>'; 
	echo ' par des points blancs sur l’écran. Une telle table peut être créée de façon personnelle, les différents composants pouvant se trouver sur le marché. Mais le budget à prévoir ';
	echo ' est d’à peu près ';
	echo ' <select class="select" name="mot10" size="1">'; 
	echo ' <option>quatre-cents</option>';
	echo ' <option>quatres cents</option>';
	echo ' <option>quatres-cent</option>';
	echo ' <option>quatre cents</option>';
	echo ' </select>'; 
	echo ' euros.';
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
	echo '					<input class="center_form" type="submit" name="valider" value="Correction" />';
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