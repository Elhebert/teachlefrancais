﻿<?php
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
		
		if( $mot1 == 'On' || $mot1 == 'on' )
		{
			$mess_mot1 = 'Correct ! C\'était bien ça !';
			$mot1_color = 'green';
			$mot1 = 'ok';
			
			$res += 1;
		}
		else
		{
			$mess_mot1 = 'Ce n\'était pas ce mot là ! La réponse était : "On"';
			$mot1_color = 'red';
			$mot1 = 'ok';
		}
	}
	if( isset($_POST['mot2']) )
	{
		$mot2 = $_POST['mot2'];
		
		if( $mot2 == 'on n\'' )
		{
			$mess_mot2 = 'Correct ! C\'était bien ça !';
			$mot2_color = 'green';
			$mot2 = 'ok';
			
			$res += 1;
		}
		else
		{
			$mess_mot2 = 'Ce n\'était pas ce mot là ! La réponse était : "on n\'"';
			$mot2_color = 'red';
			$mot2 = 'ok';
		}
	}	
	if( isset($_POST['mot3']) )
	{
		$mot3 = $_POST['mot3'];
		
		if( $mot3 == 'ou' )
		{
			$mess_mot3 = 'Correct ! C\'était bien ça !';
			$mot3_color = 'green';
			$mot3 = 'ok';
			
			$res += 1;
		}
		else
		{
			$mess_mot3 = 'Ce n\'était pas ce mot là ! La réponse était : "leur"';
			$mot3_color = 'red';
			$mot3 = 'ok';
		}
	}
	if( isset($_POST['mot4']) )
	{
		$mot4 = $_POST['mot4'];
		
		if( $mot4 == 'où' )
		{
			$mess_mot4 = 'Correct ! C\'était bien ça !';
			$mot4_color = 'green';
			$mot4 = 'ok';
			
			$res += 1;
		}
		else
		{
			$mess_mot4 = 'Ce n\'était pas ce mot là ! La réponse était : "où"';
			$mot4_color = 'red';
			$mot4 = 'ok';
		}
	}
	if( isset($_POST['mot5']) )
	{
		$mot5 = $_POST['mot5'];
		
		if( $mot5 == 'Mes' || $mot5 == 'mes' )
		{
			$mess_mot5 = 'Correct ! C\'était bien ça !';
			$mot5_color = 'green';
			$mot5 = 'ok';
			
			$res += 1;
		}
		else
		{
			$mess_mot5 = 'Ce n\'était pas ce mot là ! La réponse était : "Mes"';
			$mot5_color = 'red';
			$mot5 = 'ok';
		}
	}
	if( isset($_POST['mot6']) )
	{
		$mot6 = $_POST['mot6'];
		
		if( $mot6 == 'mets' )
		{
			$mess_mot6 = 'Correct ! C\'était bien ça !';
			$mot6_color = 'green';
			$mot6 = 'ok';
			
			$res += 1;
		}
		else
		{
			$mess_mot6 = 'Ce n\'était pas ce mot là ! La réponse était : "mets"';
			$mot6_color = 'red';
			$mot6 = 'ok';
		}
	}
	if( isset($_POST['mot7']) )
	{
		$mot7 = $_POST['mot7'];
		
		if( $mot7 == 'M\'est' || $mot7 == 'm\'est' )
		{
			$mess_mot7 = 'Correct ! C\'était bien ça !';
			$mot7_color = 'green';
			$mot7 = 'ok';
			
			$res += 1;
		}
		else
		{
			$mess_mot7 = 'Ce n\'était pas ce mot là ! La réponse était : "M\'est"';
			$mot7_color = 'red';
			$mot7 = 'ok';
		}
	}
	
	if( isset($_GET['act']) )
	{
		$res = ($res/7)*100;
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
echo '				<form id="contact" method="post" action="index.php?page=exe&type=homophone&exe=3&act=cor">';
echo '				<div class="center_form">On n\' - On :</div>';
					if( isset($mot1) && $mot1 == "ok" )
					{
echo '					<font color="'.$mot1_color.'">On</font> a pu dire tout ce qu\'on voulait.';
					}
					else
					{
echo '					<input class="center_form" type="text" name="mot1" />'; 
echo '					a pu dire tout ce qu\'on voulait..';
					}
					if( isset($mess_mot1) && $mess_mot1 != '' )
					{
echo '				<div class="message">';
echo 					$mess_mot1;
echo '				</div>';
					}
echo '			</li>';
echo '			<li>';
echo '				<br>';
					if( isset($mot2) && $mot2 == "ok" )
					{
echo '					<font color="'.$mot2_color.'">On n\'</font> est pas d\'accord sur ce sujet.';
					}
					else
					{
echo '					<input class="center_form" type="text" name="mot2" /> ';
echo '					est pas d\'accord sur ce sujet.';
					}
					if( isset($mess_mot2) && $mess_mot2 != '' )
					{
echo '				<div class="message">';
echo 					$mess_mot2;
echo '				</div>';
					}
echo '			</li>';
echo '			<li>';
echo '			<br><br>';
echo '				<div class="center_form">Leur - Leurs :</div>';
					if( isset($mot3) && $mot3 == "ok" )
					{
echo '					Durant l\'Antiquité, le père avait le droit de vie <font color="'.$mot3_color.'">ou</font> de mort sur sa femme et ses enfants.';
					}
					else
					{
echo '					Durant l\'Antiquité, le père avait le droit de vie ';
echo '					<input class="center_form" type="text" name="mot3" />'; 
echo '					de mort sur sa femme et ses enfants.';				
					}
					if( isset($mess_mot3) && $mess_mot3 != '' )
					{
echo '				<div class="message">';
echo 					$mess_mot3;
echo '				</div>';
					}
echo '			</li>';
echo '			<li>';
echo '			<br>';
					if( isset($mot4) && $mot4 == "ok" )
					{
echo '					Il ne savait pas <font color="'.$mot4_color.'">où</font> il devait aller.';
					}
					else
					{
echo '					Il ne savait pas ';					
echo '					<input class="center_form" type="text" name="mot4" />'; 
echo '					il devait aller.';				
					}
					if( isset($mess_mot4) && $mess_mot4 != '' )
					{
echo '				<div class="message">';
echo 					$mess_mot4;
echo 					'<br>';
echo 					$mess_mot5;
echo '				</div>';
					}
echo '			</li>';
echo '			<li>';
echo '			<br><br>';
echo '				<div class="center_form">Mes - Mets - M\'est :</div>';
					if( isset($mot5) && $mot5 == "ok" )
					{
echo '					<font color="'.$mot5_color.'">Mes</font> programmes ne fonctionnent pas.';
					}
					else
					{					
echo '					<input class="center_form" type="text" name="mot5" />'; 
echo '					programmes ne fonctionnent pas.';				
					}
					if( isset($mess_mot5) && $mess_mot5 != '' )
					{
echo '				<div class="message">';
echo 					$mess_mot5;
echo '				</div>';
					}
echo '			</li>';
echo '			<li>';
echo '			<br>';
					if( isset($mot6) && $mot6 == "ok" )
					{
echo '					Tu <font color="'.$mot6_color.'">mets</font> un terme à cette folie immédiatement.';
					}
					else
					{
echo '					Tu ';					
echo '					<input class="center_form" type="text" name="mot6" />'; 
echo '					un terme à cette folie immédiatement.';				
					}
					if( isset($mess_mot6) && $mess_mot6 != '' )
					{
echo '				<div class="message">';
echo 					$mess_mot6;
echo '				</div>';
					}
echo '			</li>';
echo '			<li>';
echo '			<br>';
					if( isset($mot7) && $mot7 == "ok" )
					{
echo '					<font color="'.$mot7_color.'">M\'est</font>-il un jour arrivé de te mentir ?';
					}
					else
					{
echo '					<input class="center_form" type="text" name="mot7" />'; 
echo '					-il un jour arrivé de te mentir ?';				
					}
					if( isset($mess_mot7) && $mess_mot7 != '' )
					{
echo '				<div class="message">';
echo 					$mess_mot7;
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