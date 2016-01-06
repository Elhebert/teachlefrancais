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
			
			$resultat['Nb_voc'] += 1;
			
		}
		

		$res = 0;
	}
	
	$mot1_color = 'white';
	$mot2_color = 'white';
	$mot3_color = 'white';
	
	if( isset($_POST['mot1']) )
	{
		$mot1 = $_POST['mot1'];
		
		if( $mot1 == 'processeur' || $mot1 == 'Processeur' || $mot1 == 'CPU' || $mot1 == 'cpu' )
		{
			$mess_mot1 = 'Correct ! C\'était bien ça !';
			$mot1_color = 'green';
			$mot1 = 'ok';
			
			$res += 1;
		}
		else
		{
			$mess_mot1 = 'Ce n\'était pas ce mot là ! La réponse était : "processeur (ou CPU)"';
			$mot1_color = 'red';
			$mot1 = 'ok';
		}
	}
	if( isset($_POST['mot2']) )
	{
		$mot2 = $_POST['mot2'];
		
		if( $mot2 == 'USB' || $mot2 == 'usb' || $mot2 == 'Usb' )
		{
			$mess_mot2 = 'Correct ! C\'était bien ça !';
			$mot2_color = 'green';
			$mot2 = 'ok';
			
			$res += 1;
		}
		else
		{
			$mess_mot2 = 'Ce n\'était pas ce mot là ! La réponse était : "USB"';
			$mot2_color = 'red';
			$mot2 = 'ok';
		}
	}	
	if( isset($_POST['mot3']) )
	{
		$mot3 = $_POST['mot3'];
		
		if( $mot3 == 'SSD' || $mot3 == 'Solid state drive' || $mot3 == 'Solid State Drive' || $mot3 == 'ssd' )
		{
			$mess_mot3 = 'Correct ! C\'était bien ça !';
			$mot3_color = 'green';
			$mot3 = 'ok';
			
			$res += 1;
		}
		else
		{
			$mess_mot3 = 'Ce n\'était pas ce mot là ! La réponse était : "Solid state drive (ou SSD)"';
			$mot3_color = 'red';
			$mot3 = 'ok';
		}
	}
	
	if( isset($_GET['act']) )
	{
		$res = ($res/3)*100;
		$pt_ex = round(100*$res)/100;
		
		$res = $resultat['Vocabulaire'] + $res;
		
		$resultat['Vocabulaire'] = $res;
		
		$resultat['Pourc_voc'] = $resultat['Vocabulaire'] / $resultat['Nb_voc'];
		
		
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

echo '<div id="content">';
echo '	<div class="content">';
echo '		<ul>';
echo '			<li>';
echo '				<form id="contact" method="post" action="index.php?page=exe&type=voc&exe=2&act=cor">';
echo '				<div class="center_form">Définition 1 :</div>';
					if( isset($mot1) && $mot1 == "ok" )
					{
echo '					Le <font color="'.$mot1_color.'">processeur</font> est le composant de l\'ordinateur qui exécute les programmes informatiques.';
echo '	 				Avec la mémoire notamment, c\'est l\'un des composants qui existent depuis les premiers ordinateurs et qui sont présents dans tous les ordinateurs.';
					}
					else
					{
echo '					C\'est le composant de l\'ordinateur qui exécute les programmes informatiques.';
echo '	 				Avec la mémoire notamment, c\'est l\'un des composants qui existent depuis les premiers ordinateurs et qui sont présents dans tous les ordinateurs.';
echo '					<br><br>';
echo '					Réponse : <input class="center_form" type="text" name="mot1" />';
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
echo '				<div class="center_form">Définition 2 :</div>';
					if( isset($mot2) && $mot2 == "ok" )
					{
echo '					L\'<font color="'.$mot2_color.'">Universal Serial Bus (USB)</font> est une norme relative à un bus informatique en transmission série qui sert à connecter des périphériques informatiques à un ordinateur.';
echo '					Le bus <font color="'.$mot2_color.'">USB</font> permet de connecter des périphériques à chaud (quand l\'ordinateur est en marche) et en bénéficiant du Plug and Play (le système reconnaît automatiquement le périphérique).'; 
echo '					Il peut alimenter certains périphériques en énergie, et dans sa version 2, il autorise des débits allant de 1,5 Mbit/s à 480 Mbit/s. La version 3 propose des débits jusqu\'à 5 Gbit/s,'; 
echo '					proches des 6 Gbit/s du SATA 3.';
					}
					else
					{
echo '					C\'est une norme relative à un bus informatique en transmission série qui sert à connecter des périphériques informatiques à un ordinateur.';
echo '					Ce bus permet de connecter des périphériques à chaud (quand l\'ordinateur est en marche) et en bénéficiant du Plug and Play (le système reconnaît automatiquement le périphérique).'; 
echo '					Il peut alimenter certains périphériques en énergie, et dans sa version 2, il autorise des débits allant de 1,5 Mbit/s à 480 Mbit/s. La version 3 propose des débits jusqu\'à 5 Gbit/s,'; 
echo '					proches des 6 Gbit/s du SATA 3.';
echo '					<br><br>';
echo '					Réponse : <input class="center_form" type="text" name="mot2" />';	
					}
					if( isset($mess_mot2) && $mess_mot2 != '' )
					{
echo '				<div class="message">';
echo 					$mess_mot2;
echo '				</div>';
					}
echo '			</li>';
echo '			<li>';
echo '				<br>';
echo '				<div class="center_form">Définition 3 :</div>';
					if( isset($mot3) && $mot3 == "ok" )
					{
echo '					Un <font color="'.$mot3_color.'">SSD</font> est un matériel informatique permettant le stockage de données, constitué de mémoire flash. Ces mémoires sont des éléments immobiles sur lequel les données sont écrites sur un support magnétique'; 
echo '					en rotation rapide. Un <font color="'.$mot3_color.'">SSD</font> est moins fragile mécaniquement qu\'un disque dur, les plateaux de ces derniers étant de plus en plus souvent en verre depuis 2003. Les <font color="'.$mot3_color.'">SSD</font> offrent un temps d\'accès bien'; 
echo '					plus court qu\'un disque dur à plateau (0,1 ms contre 13 ms), des débits augmentés jusqu\'à 50 Mio/s en lecture et 500 Mio/s en écriture pour les modèles exploitants l\'interface SATA III ou SAS 2.0,'; 
echo '					ainsi qu\'une consommation électrique diminuée.';
					}
					else
					{
echo '					C\'est un matériel informatique permettant le stockage de données, constitué de mémoire flash. Ces mémoires sont des éléments immobiles sur lequel les données sont écrites sur un support magnétique'; 
echo '					en rotation rapide. Il est moins fragile mécaniquement qu\'un disque dur, les plateaux de ces derniers étant de plus en plus souvent en verre depuis 2003. Ils offrent un temps d\'accès bien';  
echo '					plus court qu\'un disque dur à plateau (0,1 ms contre 13 ms), des débits augmentés jusqu\'à 50 Mio/s en lecture et 500 Mio/s en écriture pour les modèles exploitants l\'interface SATA III ou SAS 2.0,'; 
echo '					ainsi qu\'une consommation électrique diminuée.';
echo '					<br><br>';
echo '					Réponse : <input class="center_form" type="text" name="mot3" />';						
					}
					if( isset($mess_mot3) && $mess_mot3 != '' )
					{
echo '				<div class="message">';
echo 					$mess_mot3;
echo '				</div>';
					}
echo '			</li>';
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
