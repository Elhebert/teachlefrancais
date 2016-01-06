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
		
		if( $mot1 == 'apparition' )
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
		
		if( $mot2 == 'connexions' )
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
		
		if( $mot3 == 'permettant' )
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
		
		if( $mot4 == 'complexes' )
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
		
		if( $mot5 == 'succession' )
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
		
		if( $mot6 == 'interpréter' )
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
		
		if( $mot7 == 'simultanément' )
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
		
		if( $mot8 == 'multi-utilisateurs' )
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
		
		if( $mot9 == 's\'intèresse' )
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
		
		if( $mot10 == 'reprit' )
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
	echo '				<form method="post" action="index.php?page=exe&type=ortho&exe=2&act=cor">';
						if( isset($text) && $text == "ok" )
						{
	echo ' C\'est ainsi que la commercialisation du multi-touch  fait son <font color="'.$mot1_color.'">apparition</font>. Contrairement à la majorité des consommateurs qui ne peuvent utiliser qu\'un point de contact à la fois, ';
	echo ' certains vont pouvoir en utiliser plusieurs. Le multi-touch est une combinaison de <font color="'.$mot2_color.'">connexions</font> et de méthodes de détection allant du hardware vers le software et <font color="'.$mot3_color.'">permettant</font> de déduire ';
	echo ' les intentions de l\'utilisateur.<br>';
	echo ' En 2001, La société Mitsubishi Research Labs introduit son écran Diamond Touch, et par la même occasion les gestes <font color="'.$mot4_color.'">complexes</font>. L\'écran est maintenant capable d\'interpréter une suite de ';
	echo ' touchée comme un seul et même geste complexe et non comme une <font color="'.$mot5_color.'">succession</font> de coordonnées. Cela permet d\'apporter de nouvelles possibilités comme la prise en compte de l\'angle ';
	echo ' d\'approche, la direction ou la vitesse des doigts sur l\'écran.<br>';
	echo ' En 2003, le premier écran multi-utilisateur fait son apparition. L\'université de Toronto invente un dispositif qui peut analyser et <font color="'.$mot6_color.'">interpréter</font> les actions de différents utilisateurs ';
	echo ' <font color="'.$mot7_color.'">simultanément</font> sur un seul et unique écran.<br>';
	echo ' En 2005, Jefferson Han, chercheur à l\'université de New York, développe une nouvelle technologie, le FTIR, lui permettant de mettre au point un "mur" ';
	echo ' tactile multi-touch et <font color="'.$mot8_color.'">multi-utilisateurs</font> à bas cout. Cette technologie fait de Jefferson Han la référence dans le domaine du tactile. Il fonde en 2006 la société Perceptive Pixel.';
	echo ' Dans la lignée en 2007, Apple sort son iPhone et permet au grand public d\'apprécier ce nouveau système d\'interface, poussant le développement des technologies tactiles dans le monde, ';
	echo ' ce qui nous amène aujourd\'hui à les retrouver partout : hôpitaux, magasins, musées, industries, à la maison et même sur nous.<br>';
	echo ' Le monde du jeu vidéo <font color="'.$mot9_color.'">s\intéresse</font> aussi aux technologies tactiles. Une tentative de console portable avec un écran tactile fut lancée par SEGA, qui laissa tomber, à cause du prix de la'; 
	echo ' technologie tactile dans le début des années 90. La Nintendo DS <font color="'.$mot10_color.'">reprit</font> le principe en 2004 et connut un énorme succès.<br>';
						}
						else
						{
	echo ' C\'est ainsi que la commercialisation du multi-touch  fait son ';
	echo ' <select class="select" name="mot1" size="1">'; 
	echo ' <option>aparition</option>';
	echo ' <option>apparicion</option>';
	echo ' <option>apparition</option>';
	echo ' <option>apparrition</option>';
	echo ' </select>'; 
	echo '. Contrairement à la majorité des consommateurs qui ne peuvent utiliser qu\'un point de contact à la fois, certains vont pouvoir en utiliser plusieurs. Le multi-touch est'; 
	echo ' une combinaison de ';
	echo ' <select class="select" name="mot2" size="1">'; 
	echo ' <option>connections</option>';
	echo ' <option>connexions</option>';
	echo ' <option>conections</option>';
	echo ' <option>conecxions</option>';
	echo ' </select>'; 
	echo ' et de méthodes de détection allant du hardware vers le software et ';
	echo ' <select class="select" name="mot3" size="1">'; 
	echo ' <option>permetant</option>';
	echo ' <option>permettant</option>';
	echo ' <option>permêttant</option>';
	echo ' <option>permètant</option>';
	echo ' </select>';
	echo ' de déduire les intentions de l\'utilisateur.<br> En 2001, La société Mitsubishi Research Labs introduit son écran Diamond Touch, et par la même occasion les gestes'; 
	echo ' <select class="select" name="mot4" size="1">'; 
	echo ' <option>complexe</option>';
	echo ' <option>conplexes</option>';
	echo ' <option>complexes</option>';
	echo ' </select>'; 
	echo '. L\'écran est maintenant capable d\'interpréter une suite de touchée comme un seul et même geste complexe et non comme une ';
	echo ' <select class="select" name="mot5" size="1">'; 
	echo ' <option>succession</option>';
	echo ' <option>succèssion</option>';
	echo ' <option>succètion</option>';
	echo ' <option>succetion</option>';
	echo ' </select>'; 
	echo ' de coordonnées. Cela permet d\'apporter de nouvelles possibilités comme la prise en compte de l\'angle d\'approche, la direction ou la vitesse des doigts sur l\'écran.<br>';
	echo ' En 2003, le premier écran multi-utilisateur fait son apparition. L\'université de Toronto invente un dispositif qui peut analyser et ';
	echo ' <select class="select" name="mot6" size="1">'; 
	echo ' <option>interpreter</option>';
	echo ' <option>interpréter</option>';
	echo ' <option>interpreté</option>';
	echo ' <option>interprèter</option>';
	echo ' </select>';
	echo ' les actions de différents utilisateurs ';
	echo ' <select class="select" name="mot7" size="1">'; 
	echo ' <option>simultanement</option>';
	echo ' <option>simmultanément</option>';
	echo ' <option>simultannément</option>';
	echo ' <option>simultanément</option>';
	echo ' </select>';
	echo ' sur un seul et unique écran.<br> En 2005, Jefferson Han, chercheur à l\'université de New York, développe une nouvelle technologie, le FTIR, lui permettant de mettre'; 
	echo ' au point un "mur" tactile multi-touch et ';
	echo ' <select class="select" name="mot8" size="1">'; 
	echo ' <option>multis-utilisateurs</option>';
	echo ' <option>multiutilisateurs</option>';
	echo ' <option>multi-utilisateurs</option>';
	echo ' <option>multi-utilisateur</option>';
	echo ' </select>';
	echo ' à bas cout. Cette technologie fait de Jefferson Han la référence dans le domaine du tactile. Il fonde en 2006 la société Perceptive Pixel. Dans la ligné en 2007, Apple sort ';
	echo ' son iPhone et permet au grand public d\'apprécier ce nouveau système d\'interface, poussant le développement des technologies tactiles dans le monde, ce qui nous amène '; 
	echo ' aujourd\'hui à les retrouver partout : hôpitaux, magasins, musées, industries, à la maison et même sur nous.<br> Le monde du jeu vidéo ';
	echo ' <select class="select" name="mot9" size="1">'; 
	echo ' <option>s\'intéresse</option>';
	echo ' <option>s\'interesse</option>';
	echo ' <option>s\'intèresse</option>';
	echo ' <option>s\'intêresse</option>';
	echo ' </select>';
	echo ' aussi aux technologies tactiles. Une tentative de console portable avec un écran tactile fut lancée par SEGA, qui laissa tomber, à cause du prix de la'; 
	echo ' technologie tactile dans le début des années 90. La Nintendo DS ';
	echo ' <select class="select" name="mot10" size="1">'; 
	echo ' <option>repris</option>';
	echo ' <option>reprit</option>';
	echo ' <option>repri</option>';
	echo ' </select>';
	echo ' le principe en 2004 et connut un énorme succès.<br>';
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