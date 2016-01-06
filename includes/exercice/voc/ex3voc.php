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
		
		if( $mot1 == 'widget' || $mot1 == 'Widget' )
		{
			$mess_mot1 = 'Correct ! C\'était bien ça !';
			$mot1_color = 'green';
			$mot1 = 'ok';
			
			$res += 1;
		}
		else
		{
			$mess_mot1 = 'Ce n\'était pas ce mot là ! La réponse était : "widget"';
			$mot1_color = 'red';
			$mot1 = 'ok';
		}
	}
	if( isset($_POST['mot2']) )
	{
		$mot2 = $_POST['mot2'];
		
		if( $mot2 == 'HDMI' || $mot2 == 'hdmi')
		{
			$mess_mot2 = 'Correct ! C\'était bien ça !';
			$mot2_color = 'green';
			$mot2 = 'ok';
			
			$res += 1;
		}
		else
		{
			$mess_mot2 = 'Ce n\'était pas ce mot là ! La réponse était : "HDMI"';
			$mot2_color = 'red';
			$mot2 = 'ok';
		}
	}	
	if( isset($_POST['mot3']) )
	{
		$mot3 = $_POST['mot3'];
		
		if( $mot3 == 'serveur' || $mot3 == 'server' )
		{
			$mess_mot3 = 'Correct ! C\'était bien ça !';
			$mot3_color = 'green';
			$mot3 = 'ok';
			
			$res += 1;
		}
		else
		{
			$mess_mot3 = 'Ce n\'était pas ce mot là ! La réponse était : "serveur"';
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
echo '				<form id="contact" method="post" action="index.php?page=exe&type=voc&exe=3&act=cor">';
echo '				<div class="center_form">Définition 1 :</div>';
					if( isset($mot1) && $mot1 == "ok" )
					{
echo '					En informatique, le mot <font color="'.$mot1_color.'">widget</font> recouvre deux notions distinctes en relation avec les interfaces graphiques. Il peut alors être considéré comme étant la contraction'; 
echo '					des termes window (fenêtre) et gadget. Il peut désigner :';
echo '					un composant d\'interface graphique, un élément visuel d\'une interface graphique (bouton, ascenseur, liste déroulante, etc.) ';
					}
					else
					{
echo '					En informatique, il recouvre deux notions distinctes en relation avec les interfaces graphiques. Il peut alors être considéré comme étant la contraction'; 
echo '					des termes window (fenêtre) et gadget. Il peut désigner :';
echo '					un composant d\'interface graphique, un élément visuel d\'une interface graphique (bouton, ascenseur, liste déroulante, etc.) ';
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
echo '					L\'<font color="'.$mot2_color.'">HDMI</font> est une norme et interface audio/vidéo totalement numérique pour transmettre des flux chiffrés, principalement non compressés et destinés au marché grand public.';
echo '					L\'<font color="'.$mot2_color.'">HDMI</font> permet de relier une source audio/vidéo DRM – comme un lecteur Blu-ray, un ordinateur ou une console de jeu – à un dispositif compatible – tel un téléviseur HD ou un';
echo '					vidéoprojecteur.';
					}
					else
					{
echo '					Il s\'agit d\'une norme et interface audio/vidéo totalement numérique pour transmettre des flux chiffrés, principalement non compressés et destinés au marché grand public.';
echo '					Elle permet de relier une source audio/vidéo DRM – comme un lecteur Blu-ray, un ordinateur ou une console de jeu – à un dispositif compatible – tel un téléviseur HD ou un';
echo '					vidéoprojecteur.';
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
echo '					Un <font color="'.$mot3_color.'">serveur</font> informatique est un dispositif informatique matériel ou logiciel qui offre des services, à différents clients. Les services les plus courants sont :<br>';
echo '					*	le partage de fichiers<br>';
echo '					*	l\'accès aux informations du World Wide Web<br>';
echo '					*	le courrier électronique<br>';
echo '					*	le partage d\'imprimantes<br>';
echo '					*	le commerce électronique<br>';
echo '					*	le stockage en base de données<br>';
echo '					*	le jeu et la mise à disposition de logiciels applicatifs (optique software as a service).<br>';
echo '					Un <font color="'.$mot3_color.'">serveur</font> fonctionne en permanence, répondant automatiquement à des requêtes provenant d\'autres dispositifs informatiques (les clients), selon le principe dit client-<font color="'.$mot3_color.'">serveur</font>. Le format des requêtes et des ';
echo '					résultats est normalisé, se conforme à des protocoles réseaux et chaque service peut être exploité par tout client qui met en œuvre le protocole propre à ce service.';
echo '					Les serveurs sont utilisés par les entreprises, les institutions et les opérateurs de télécommunication. Ils sont courants dans les centres de traitement de données et le réseau Internet.';
					}
					else
					{
echo '					C\'est un dispositif informatique matériel ou logiciel qui offre des services, à différents clients. Les services les plus courants sont : ';
echo '					le partage de fichiers, ';
echo '					l\'accès aux informations du World Wide Web, ';
echo '					le courrier électronique, ';
echo '					le partage d\'imprimantes, ';
echo '					le commerce électronique, ';
echo '					le stockage en base de données, ';
echo '					le jeu et la mise à disposition de logiciels applicatifs (optique software as a service).<br>';
echo '					Il fonctionne en permanence, répondant automatiquement à des requêtes provenant d\'autres dispositifs informatiques (les clients). Le format des requêtes et des ';
echo '					résultats est normalisé, se conforme à des protocoles réseaux et chaque service peut être exploité par tout client qui met en œuvre le protocole propre à ce service.';
echo '					Les serveurs sont utilisés par les entreprises, les institutions et les opérateurs de télécommunication. Ils sont courants dans les centres de traitement de données et le réseau Internet.';		
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
