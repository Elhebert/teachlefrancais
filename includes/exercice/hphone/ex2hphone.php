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
			
			$resultat['Nb_hphone'] += 1;
			
		}
		

		$res = 0;
	}
	
	$mot1_color = 'white';
	$mot2_color = 'white';
	$mot3_color = 'white';
	
	if( isset($_POST['mot1']) )
	{
		$mot1 = $_POST['mot1'];
		
		if( $mot1 == 'n\'y' )
		{
			$mess_mot1 = 'Correct ! C\'était bien ça !';
			$mot1_color = 'green';
			$mot1 = 'ok';
			
			$res += 1;
		}
		else
		{
			$mess_mot1 = 'Ce n\'était pas ce mot là ! La réponse était : "n\'y"';
			$mot1_color = 'red';
			$mot1 = 'ok';
		}
	}
	if( isset($_POST['mot2']) )
	{
		$mot2 = $_POST['mot2'];
		
		if( $mot2 == 'ni' )
		{
			$mess_mot2 = 'Correct ! C\'était bien ça !';
			$mot2_color = 'green';
			$mot2 = 'ok';
			
			$res += 1;
		}
		else
		{
			$mess_mot2 = 'Ce n\'était pas ce mot là ! La réponse était : "ni"';
			$mot2_color = 'red';
			$mot2 = 'ok';
		}
	}	
	if( isset($_POST['mot3']) )
	{
		$mot3 = $_POST['mot3'];
		
		if( $mot3 == 'ni' )
		{
			$mess_mot3 = 'Correct ! C\'était bien ça !';
			$mot3_color = 'green';
			$mot3 = 'ok';
			
			$res += 1;
		}
		else
		{
			$mess_mot3 = 'Ce n\'était pas ce mot là ! La réponse était : "ni"';
			$mot3_color = 'red';
			$mot3 = 'ok';
		}
	}
	if( isset($_POST['mot4']) )
	{
		$mot4 = $_POST['mot4'];
		
		if( $mot4 == 'n\'y' )
		{
			$mess_mot4 = 'Correct ! C\'était bien ça !';
			$mot4_color = 'green';
			$mot4 = 'ok';
			
			$res += 1;
		}
		else
		{
			$mess_mot4 = 'Ce n\'était pas ce mot là ! La réponse était : "n\'y"';
			$mot4_color = 'red';
			$mot4 = 'ok';
		}
	}
	if( isset($_POST['mot5']) )
	{
		$mot5 = $_POST['mot5'];
		
		if( $mot5 == 'ces' )
		{
			$mess_mot5 = 'Correct ! C\'était bien ça !';
			$mot5_color = 'green';
			$mot5 = 'ok';
			
			$res += 1;
		}
		else
		{
			$mess_mot5 = 'Ce n\'était pas ce mot là ! La réponse était : "ces"';
			$mot5_color = 'red';
			$mot5 = 'ok';
		}
	}
	if( isset($_POST['mot6']) )
	{
		$mot6 = $_POST['mot6'];
		
		if( $mot6 == 'ses' )
		{
			$mess_mot6 = 'Correct ! C\'était bien ça !';
			$mot6_color = 'green';
			$mot6 = 'ok';
			
			$res += 1;
		}
		else
		{
			$mess_mot6 = 'Ce n\'était pas ce mot là ! La réponse était : "ses"';
			$mot6_color = 'red';
			$mot6 = 'ok';
		}
	}
	if( isset($_POST['mot7']) )
	{
		$mot7 = $_POST['mot7'];
		
		if( $mot7 == 'son' )
		{
			$mess_mot7 = 'Correct ! C\'était bien ça !';
			$mot7_color = 'green';
			$mot7 = 'ok';
			
			$res += 1;
		}
		else
		{
			$mess_mot7 = 'Ce n\'était pas ce mot là ! La réponse était : "son"';
			$mot7_color = 'red';
			$mot7 = 'ok';
		}
	}
	if( isset($_POST['mot8']) )
	{
		$mot8 = $_POST['mot8'];
		
		if( $mot8 == 'son' )
		{
			$mess_mot8 = 'Correct ! C\'était bien ça !';
			$mot8_color = 'green';
			$mot8 = 'ok';
			
			$res += 1;
		}
		else
		{
			$mess_mot8 = 'Ce n\'était pas ce mot là ! La réponse était : "son"';
			$mot8_color = 'red';
			$mot8= 'ok';
		}
	}
	
	if( isset($_GET['act']) )
	{
		$res = ($res/8)*100;
		$pt_ex = round(100*$res)/100;
		
		$res = $resultat['Homophone'] + $res;
		
		$resultat['Homophone'] = $res;
		
		$resultat['Pourc_hphone'] = $resultat['Homophone'] / $resultat['Nb_hphone'];
		
		
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
?><?php
echo '<div id="content">';
echo '	<div class="content">';
echo '		<ul>';
echo '			<li>';
echo '				<form id="contact" method="post" action="index.php?page=exe&type=homophone&exe=2&act=cor">';
echo '				<div class="center_form">Ni - N\'y :</div>';
					if( (isset($mot1) && $mot1 == "ok") && (isset($mot3) && $mot3 == "ok") && (isset($mot2) && $mot2 == "ok"))
					{
echo '					Il <font color="'.$mot1_color.'">n\'y</font> a <font color="'.$mot2_color.'">ni</font> fruits, <font color="'.$mot3_color.'">ni</font> légumes dans ce frigo.';
					}
					else
					{
echo '					Il <input class="center_form" type="text" name="mot1" /> a <input class="center_form" type="text" name="mot2" /> fruits, <input class="center_form" type="text" name="mot3" /> légumes dans ce frigo.';
					}
					if( (isset($mess_mot1) && $mess_mot1 != '' ) && (isset($mess_mot3) && $mess_mot3 != '') && (isset($mess_mot2) && $mess_mot2 != ''))
					{
echo '				<div class="message">';
echo 					$mess_mot1;
echo 					'<br>';
echo 					$mess_mot2;
echo 					'<br>';
echo 					$mess_mot3;
echo '				</div>';
					}
echo '			</li>';
echo '			<li>';
echo '				<br>';
					if( isset($mot4) && $mot4 == "ok" )
					{
echo '					Si tu voulais sortir ce soir <font color="'.$mot4_color.'">n\'y</font> compte pas.';
					}
					else
					{
echo '					Si tu voulais sortir ce soir ';
echo '					<input class="center_form" type="text" name="mot4" /> ';
echo '					compte pas.';
					}
					if( isset($mess_mot4) && $mess_mot4 != '' )
					{
echo '				<div class="message">';
echo 					$mess_mot4;
echo '				</div>';
					}
echo '			</li>';
echo '			<li>';
echo '			<br><br>';
echo '				<div class="center_form">Ces - Ses :</div>';
					if( isset($mot5) && $mot5 == "ok" )
					{
echo '					Ne laissez pas <font color="'.$mot5_color.'">ces</font> belles fleurs se fâner.';
					}
					else
					{
echo '					Ne laissez pas ';
echo '					<input class="center_form" type="text" name="mot5" />'; 
echo '					belles fleurs se fâner.';				
					}
					if( isset($mess_mot5) && $mess_mot5 != '' )
					{
echo '				<div class="message">';
echo 					$mess_mot5;
echo '				</div>';
					}
echo '			</li>';
echo '			<li>';
echo '				<br>';
					if( isset($mot6) && $mot6 == "ok" )
					{
echo '					Demande lui de m\'apporter <font color="'.$mot6_color.'">ses</font> dossiers personelles.';
					}
					else
					{
echo '					Demande lui de m\'apporter ';
echo '					<input class="center_form" type="text" name="mot6" />'; 
echo '					dossiers personelles.';				
					}
					if( isset($mess_mot6) && $mess_mot6 != '' )
					{
echo '				<div class="message">';
echo 					$mess_mot6;
echo '				</div>';
					}
echo '			</li>';
echo '			<li>';
echo '			<br><br>';
echo '				<div class="center_form">Son - Sont :</div>';
					if( isset($mot7) && $mot7 == "ok" )
					{
echo '					Il ne veut pas écouter <font color="'.$mot7_color.'">son</font> père.';
					}
					else
					{
echo '					Il ne veut pas écouter <input class="center_form" type="text" name="mot7" />'; 
echo '					père.';				
					}
					if( isset($mess_mot7) && $mess_mot7 != '' )
					{
echo '				<div class="message">';
echo 					$mess_mot7;
echo '				</div>';
					}
echo '			</li>';
echo '			<li>';
echo '				<br>';
					if( isset($mot8) && $mot8 == "ok" )
					{
echo '					Ils <font color="'.$mot8_color.'">sont</font> partis en voyage';
					}
					else
					{
echo '					Ils <input class="center_form" type="text" name="mot8" />'; 
echo '					partis en voyage.';				
					}
					if( isset($mess_mot8) && $mess_mot8 != '' )
					{
echo '				<div class="message">';
echo 					$mess_mot8;
echo '				</div>';
					}
echo '			</li>';
echo '			<li>';
echo '			<br><br>';
				if( !isset($_GET['act']) )
				{
echo '				<input class="center_form" type="submit" name="valider" value="Correction" />';
				}
				else
				{
echo '				Résultat : '.$pt_ex.'%';
				}
echo '			</li>';
echo '		</ul>';
echo '	</div>';
echo '</div>';
?>