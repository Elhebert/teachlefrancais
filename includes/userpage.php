<?php
	$fic_user = 'includes/fichiers/'.$_SESSION['pseudo'].'/user.ini';
	$fic_resultat = 'includes/fichiers/'.$_SESSION['pseudo'].'/resultat.ini';
	// Création du tableau user
	$user=array();
	
	// Création du tableau resultat
	$resultat=array();
	
	// On vérifie si le fichier existe et si on arrive à le lire
	if(file_exists($fic_user) && $fic_user_lecture=file($fic_user))
	{
		if(file_exists($fic_resultat) && $fic_resultat_lecture=file($fic_resultat))
		{
			foreach($fic_user_lecture as $ligne)
			{
				@list($info,$valeur) = explode(" = ", $ligne, 2);
				$user[$info] = $valeur;
			}
			foreach($fic_resultat_lecture as $ligne)
			{
				@list($info,$valeur) = explode(" = ", $ligne, 2 );
				$resultat[$info] = $valeur;
			}
	
			if( isset($_GET['act']) && $_GET['act'] == 'edit')
			{
				/******* UPDATE DES INFOS PERSONNELLES *******/	
			
				/* Création d'une fonction - utilisée dans la récupération des variables - qui teste la configuration get_magic_quotes_gpc du serveur.
				Si oui, supprime avec la fonction stripslashes les antislashes "\" insérés dans les chaines de caractère des variables gpc (GET, POST, COOKIE) */
				function Verif_magicquotes ($chaine) 
				{
					if (get_magic_quotes_gpc()) 
					{
						$chaine = stripslashes($chaine);
					}
					return $chaine;
				} 
				$message = null;
			
				$pseudo = (isset($_POST['Pseudo']) && trim($_POST['Pseudo']) != '')? Verif_magicquotes($_POST['Pseudo']) : null;
				$passwd = (isset($_POST['Passwd']) && trim($_POST['Passwd']) != '')? Verif_magicquotes($_POST['Passwd']) : null;
				$nom = (isset($_POST['Nom']) && trim($_POST['Nom']) != '')? Verif_magicquotes($_POST['Nom']) : null;
				$prenom = (isset($_POST['Prenom']) && trim($_POST['Prenom']) != '')? Verif_magicquotes($_POST['Prenom']) : null;
				$classe = (isset($_POST['Classe']) && trim($_POST['Classe']) != '')? Verif_magicquotes($_POST['Classe']) : null;
				$groupe = (isset($_POST['Groupe']) && trim($_POST['Groupe']) != '')? Verif_magicquotes($_POST['Groupe']) : null;
				$mail = (isset($_POST['Mail']) && trim($_POST['Mail']) != '')? Verif_magicquotes($_POST['Mail']) : null;
				$age = (isset($_POST['Age']) && trim($_POST['Age']) != '')? Verif_magicquotes($_POST['Age']) : null;
				$option = (isset($_POST['option']) && trim($_POST['option']) != '')? Verif_magicquotes($_POST['option']) : null;
				
				$passwd = sha1($passwd);
				$annee_cours = $classe.' '.$option.' '.$groupe;		
				
				// On vérifie si le dossier existe déjà (s'il existe alors le pseudo est déjà pris !
				if(is_dir("includes/fichiers/".$pseudo) === false)
				{
					// On vérifie si le mot de passe entré correspond a celui contenu dans l'array $user
					if( $user["Passwd"] == $passwd )
					{
						if( $nom != '' && $user['Nom'] != $nom )
						{
							$user['Nom'] = $nom;
						}
						if( $prenom != '' && $user['Prenom'] != $prenom )
						{
							$user['Prenom'] = $prenom;
						}
						if( $mail != '' && $user['Mail'] != $mail )
						{
							$user['Mail'] = $mail;
						}
						if( $age != '' && $user['Age'] != $age )
						{
							$user['Age'] = $age;
						}
						if( $annee_cours != '' && $user['Classe'] != $annee_cours )
						{
							$user['Classe'] = $annee_cours;
						}
						if( $pseudo != '' && $_SESSION['pseudo'] != $pseudo )
						{
							rename("/includes/fichiers/".$_SESSION['pseudo'], "/includes/fichiers/".$pseudo);
							$_SESSION['pseudo'] = $pseudo;
						}
					}
					else
					{
						$message = 'Mot de passe incorrect';
					}
				}
				else
				{   
					// Le pseudo est déjà utilisé
					if( $pseudo != null)
					{
						$message = 'Ce pseudo est déjà utilisé, changez-le.';
					}
				}
				
				// On crée l'entrée a enregistrer dans le fichier
				$fichier_save="";

				// On parcours l'array en sauvegardant la clé et la valeur correspondant
				foreach($user as $cle => $valeur)
				{
					// On ajoute la ligne <clé> = <valeur>
					$fichier_save.="\n".$cle." = ".$valeur."\n";
				}
				// On ajoute le tout dans le fichier en écrasant le fichier auparavant
				file_put_contents($fic_user, $fichier_save);

				//On ferme le fichier
				@fclose($fic_user);
			}
		
			$Username = $_SESSION['pseudo'];
			$Nom_user = $user["Nom"];
			$Prenom_user = $user["Prenom"];
			$Age_user = $user["Age"];
			$Classe_user = $user["Classe"];
			$Mail_user = $user["Mail"];
			$pt_tot_homophone = round($resultat["Pourc_hphone"]*100)/100;
			$nb_tot_homophone = $resultat['Nb_hphone'];
			$pt_tot_orthographe = round($resultat["Pourc_ortho"]*100)/100;
			$nb_tot_orthographe = $resultat['Nb_ortho'];
			$pt_tot_voc = round($resultat["Pourc_voc"]*100)/100;
			$nb_tot_voc  = $resultat['Nb_voc'];
			$pt_tot_jdm = round($resultat["Pourc_jdm"]*100)/100;
			$nb_tot_jdm  = $resultat['Nb_jdm'];
			$resultat['Moyenne'] = ( $resultat['Pourc_ortho'] + $resultat['Pourc_voc'] + $resultat['Pourc_hphone'] + $resultat['Pourc_jdm']);
			$resultat['Pourc_moy'] = $resultat['Moyenne'];
			if( $resultat['Nb_ortho'] != 0 )
			{
				if( $resultat['Nb_voc'] != 0 )
				{
					if( $resultat['Nb_hphone'] != 0 )
					{
						if( $resultat['Nb_jdm'] != 0 )
						{
							$resultat['Pourc_moy'] = $resultat['Moyenne'] / ( 4 ) ;
						}
						else
						{
							$resultat['Pourc_moy'] = $resultat['Moyenne'] / ( 3 ) ;
						}
					}
					else
					{
						if( $resultat['Nb_jdm'] != 0 )
						{
							$resultat['Pourc_moy'] = $resultat['Moyenne'] / ( 3 ) ;	
						}
						else
						{
							$resultat['Pourc_moy'] = $resultat['Moyenne'] / ( 2 ) ;	
						}
					}
				}
				else
				{
					if( $resultat['Nb_hphone'] != 0 )
					{
						if( $resultat['Nb_jdm'] != 0 )
						{
							$resultat['Pourc_moy'] = $resultat['Moyenne'] / ( 3 ) ;	
						}
						else
						{
							$resultat['Pourc_moy'] = $resultat['Moyenne'] / ( 2 ) ;	
						}
					}
					else
					{
						if( $resultat['Nb_jdm'] != 0 )
						{
							$resultat['Pourc_moy'] = $resultat['Moyenne'] / ( 2 ) ;	
						}
						else
						{
							$resultat['Pourc_moy'] = $resultat['Moyenne'] / ( 1 ) ;	
						}
					}
				}
			}
			else
			{
				if( $resultat['Nb_voc'] != 0 )
				{
					if( $resultat['Nb_hphone'] != 0 )
					{
						if( $resultat['Nb_jdm'] != 0 )
						{
							$resultat['Pourc_moy'] = $resultat['Moyenne'] / ( 3 ) ;	
						}
						else
						{
							$resultat['Pourc_moy'] = $resultat['Moyenne'] / ( 2 ) ;	
						}
					}
					else
					{
						if( $resultat['Nb_jdm'] != 0 )
						{
							$resultat['Pourc_moy'] = $resultat['Moyenne'] / ( 2 ) ;	
						}
						else
						{
							$resultat['Pourc_moy'] = $resultat['Moyenne'] / ( 1 ) ;	
						}
					}
				}
				else
				{
					if( $resultat['Nb_hphone'] != 0 )
					{
						if( $resultat['Nb_jdm'] != 0 )
						{
							$resultat['Pourc_moy'] = $resultat['Moyenne'] / ( 2 ) ;	
						}
						else
						{
							$resultat['Pourc_moy'] = $resultat['Moyenne'] / ( 1 ) ;	
						}
					}
				}
			}
			
			$pt_tot_gen = round($resultat["Pourc_moy"]*100)/100;
			
			// On crée l'entrée a enregistrer dans le fichier
			$fichier_save="";

			// On parcours l'array en sauvegardant la clé et la valeur correspondant
			foreach($resultat as $cle => $valeur)
			{
				// On ajoute la ligne <clé> = <valeur>
				$fichier_save.="\n".$cle." = ".$valeur;
			}
			// On ajoute le tout dans le fichier en écrasant le fichier auparavant
			file_put_contents($fic_resultat, $fichier_save);

			//On ferme le fichier
			@fclose($fic_resultat);
		}
	}

?>
<div id="content">
	<div class="content">
<?php			
			if( isset($_GET['act']) && $_GET['act'] == "edit" )
			{
echo '			<form class="center_form" method="post" action="index.php?page=user">';
			}
echo '		<ul style="line-height:25px">';
echo '			<li>';
echo '				<div class="center_form">Page personnelle de '.$Prenom_user.' '.$Nom_user.'</div>';
echo '			</li>';
echo '			<li>';
echo '				<div class="ref">';
echo '					<fieldset>';
echo '						<legend>Mes résultats</h2></legend>';
echo '						<div style="font-variant:normal">';
echo '							<label class="user_info" for="homophone">Homophones : </label><br>';
echo '							<label class="user_info" for="homophone">Résultat : </label>';
									echo $pt_tot_homophone.'%<br>';
echo '							<label class="user_info" for="homophone">Nombre d\'exercices réalisés : </label>';
									echo $nb_tot_homophone.'<br><br>';

echo '							<label class="user_info" for="orthographe">Orthographe : </label><br>';
echo '							<label class="user_info" for="orthographe">Résultat : </label>';
									echo $pt_tot_orthographe.'%<br>';
echo '							<label class="user_info" for="orthographe">Nombre d\'exercices réalisés : </label>';
									echo $nb_tot_orthographe.'<br><br>';

echo '							<label class="user_info" for="voc">Vocabulaire : </label><br>';
echo '							<label class="user_info" for="voc">Résultat : </label>';
									echo $pt_tot_voc.'%<br>';
echo '							<label class="user_info" for="voc">Nombre d\'exercices réalisés : </label>';
									echo $nb_tot_voc.'<br><br>';

echo '							<label class="user_info" for="voc">Jeux de mots : </label><br>';
echo '							<label class="user_info" for="voc">Résultat : </label>';
									echo $pt_tot_jdm.'%<br>';
echo '							<label class="user_info" for="voc">Nombre d\'exercices réalisés : </label>';
									echo $nb_tot_jdm.'<br><br>';

echo '							<label class="user_info" for="moyenne">Moyenne générale : </label>';
									echo $pt_tot_gen.'%<br>';
echo '						</div>';
echo '					</fieldset>';
echo '				</div>';
echo '			</li>';
echo '			<li>';
echo '				<div class="ref">';
echo '				<br><br>';
echo '					<fieldset>';
echo '						<legend>Mes informations personnelles</legend>';
echo '						<div style="font-variant:normal">';
echo '							<label class="user_info" for="nom">Nom : </label>';
									if( !isset($_GET['act'])  )
									{
										echo $Nom_user.'<br>';
									}
									else
									{
										if( isset($_GET['act']) && $_GET['act'] == "edit" )
										{
											echo '<input class="center_form" type="text" name="Nom"/><br>';
										}
									}
echo '							<label class="user_info" for="prenom">Prénom : </label>';
									if( !isset($_GET['act']) )
									{
										echo $Prenom_user.'<br>';
									}
									else
									{
										if( isset($_GET['act']) && $_GET['act'] == "edit" )
										{
											echo '<input class="center_form" type="text" name="Prenom"/><br>';
										}
									}
echo '							<label class="user_info" for="age">Age : </label>';
									if( !isset($_GET['act']) )
									{
										echo $Age_user.' ans<br>';
									}
									else
									{
										if( isset($_GET['act']) && $_GET['act'] == "edit" )
										{
											echo '<input class="center_form" type="text" name="Age" size="2"/> ans<br>';
										}
									}
echo '							<label class="user_info" for="classe">Classe : </label>';
								if( !isset($_GET['act']) )
								{
									echo $Classe_user.'<br>';
								}
								else
								{
									if( isset($_GET['act']) && $_GET['act'] == "edit" )
									{
										echo '<input class="center_form" type="text" name="Classe" size="1"> <select class="select" name="option" size ="1"><option>TI</option><option>IG</option></select>  <input class="center_form" type="text" name="Groupe" size="1"><br>';
									}
								}
echo '						</div>';
echo '					</fieldset>';
echo '				</div>';
echo '			</li>';
echo '			<li>';
echo '				<div class="ref">';
echo '					<fieldset>';
echo '						<legend>Informations supplémentaire</legend>';
echo '						<div style="font-variant:normal">';		
echo '							<label class="user_info" for="mail">Adresse mail : </label>';
								if( !isset($_GET['act']) )
								{
									echo $Mail_user.'<br>';
								}
								else
								{
									if( isset($_GET['act']) && $_GET['act'] == "edit" )
									{
										echo '<input class="center_form" type="text" name="Mail" /><br>';
									}
								}
echo '							<label class="user_info" for="pseudo">Pseudo : </label>';
								if( !isset($_GET['act']) )
								{
									echo $Username.'<br>';
								}
								else
								{
									if( isset($_GET['act']) && $_GET['act'] == "edit" )
									{
										echo '<input class="center_form" type="text" name="Pseudo" /><br>';
									}
								}
								if( isset($_GET['act']) && $_GET['act'] == "edit" )
								{
echo '								<label class="user_info" for="passwd">Mot de passe (obligatoire pour valider les changements): </label>';
echo '								<input class="center_form" type="password" name="Passwd" /><br>';
								}
echo '						</div>';
echo '					</fieldset>';
echo '					<br>';
/*						if( !isset($_GET['act']) )
						{
echo '							<form class="center_form" method="post" action="index.php?page=user&act=edit">';
echo '							<input class="bouton" type="submit" name="edit_user" value="Changer mes informations" />';
echo '						</form>';
						}
						else
						{
							if( isset($_GET['act']) && $_GET['act'] == "edit" )
							{
echo '								<input class="bouton" type="submit" name="edit_user" value="Valider les changements" />';
							}
						}
						if( isset($message) && isset($_GET['act']) && $_GET['act'] == "edit" )
						{
							echo $message;
						}*/
echo '				</div>';
echo '			</li>';
echo '		</ul>';
echo '		</form>';
?>
	</div>
</div>