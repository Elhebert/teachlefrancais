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
		
		if( $mot1 == 'adresse IP' || $mot1 == 'adresse ip' || $mot1 == 'Adresse ip' )
		{
			$mess_mot1 = 'Correct ! C\'était bien ça !';
			$mot1_color = 'green';
			$mot1 = 'ok';
			
			$res += 1;
		}
		else
		{
			$mess_mot1 = 'Ce n\'était pas ce mot là ! La réponse était : "adresse IP"';
			$mot1_color = 'red';
			$mot1 = 'ok';
		}
	}
	if( isset($_POST['mot2']) )
	{
		$mot2 = $_POST['mot2'];
		
		if( $mot2 == 'PHP' || $mot2 == 'php')
		{
			$mess_mot2 = 'Correct ! C\'était bien ça !';
			$mot2_color = 'green';
			$mot2 = 'ok';
			
			$res += 1;
		}
		else
		{
			$mess_mot2 = 'Ce n\'était pas ce mot là ! La réponse était : "PHP"';
			$mot2_color = 'red';
			$mot2 = 'ok';
		}
	}	
	if( isset($_POST['mot3']) )
	{
		$mot3 = $_POST['mot3'];
		
		if( $mot3 == 'ethernet' || $mot3 == 'Ethernet' )
		{
			$mess_mot3 = 'Correct ! C\'était bien ça !';
			$mot3_color = 'green';
			$mot3 = 'ok';
			
			$res += 1;
		}
		else
		{
			$mess_mot3 = 'Ce n\'était pas ce mot là ! La réponse était : "ethernet"';
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
?><?php
echo '<div id="content">';
echo '	<div class="content">';
echo '		<ul>';
echo '			<li>';
echo '				<form id="contact" method="post" action="index.php?page=exe&type=voc&exe=1&act=cor">';
echo '				<div class="center_form">Définition 1 :</div>';
					if( isset($mot1) && $mot1 == "ok" )
					{
echo '					Une <font color="'.$mot1_color.'">adresse IP</font> est un numéro d\'identification qui est attribué à chaque branchement d\'appareil à un réseau informatique.';
					}
					else
					{
echo '					C\'est un numéro d\'identification qui est attribué à chaque branchement d\'appareil à un réseau informatique.';
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
echo '					Le <font color="'.$mot2_color.'">PHP</font> est un langage de scripts libre principalement utilisé pour produire des pages Web dynamiques via un serveur HTTP,';
echo '					mais pouvant également fonctionner comme n\'importe quel langage interprété de façon locale, en exécutant les programmes en ligne de commande. <font color="'.$mot2_color.'">PHP</font> est un langage impératif disposant depuis la version 5';
echo '					de fonctionnalités de modèle objet complètes.';					}
					else
					{
echo '					C\'est un langage de scripts libre principalement utilisé pour produire des pages Web dynamiques via un serveur HTTP,';
echo '					mais pouvant également fonctionner comme n\'importe quel langage interprété de façon locale, en exécutant les programmes en ligne de commande.C\'est un langage impératif disposant depuis la version 5';
echo '					de fonctionnalités de modèle objet complètes.';
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
echo '					<font color="'.$mot3_color.'">Ethernet</font> est un protocole de réseau local à commutation de paquets. Bien qu\'il implémente la couche physique (PHY) et la sous-couche Media Access Control (MAC) du modèle IEEE 802, le protocole <font color="'.$mot3_color.'">Ethernet</font> est classé dans la ';
echo '					couche de liaison, car les formats de trames que le standard définit sont normalisés et peuvent être encapsulés dans des protocoles autres que ses propres couches physiques MAC et PHY.';
					}
					else
					{
echo '					C\'est un protocole de réseau local à commutation de paquets. Bien qu\'il implémente la couche physique (PHY) et la sous-couche Media Access Control (MAC) du modèle IEEE 802, ce protocole est classé dans la ';
echo '					couche de liaison, car les formats de trames que le standard définit sont normalisés et peuvent être encapsulés dans des protocoles autres que ses propres couches physiques MAC et PHY.';		
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