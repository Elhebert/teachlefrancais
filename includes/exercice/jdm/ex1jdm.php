<?php

	if( !isset($_GET['act']) )
	{
		$mess_text = null;
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
			
			$resultat['Nb_jdm'] += 1;
			
		}

		$res = 0;
	}
	
	$rep1_color = 'white';
	$rep2_color = 'white';
	$rep3_color = 'white';
	$rep4_color = 'white';
	$rep5_color = 'white';
	$rep6_color = 'white';
	$rep7_color = 'white';
	$rep8_color = 'white';
	$rep9_color = 'white';
	$rep10_color = 'white';
	
	if( isset($_POST['rep1']) )
	{
		$rep1 = $_POST['rep1'];
		
		if( $rep1 == 'François Rabellais' || $rep1 == 'françois rabellais' )
		{
			$mess_rep1 = 'Correct ! C\'était bien ça !';
			$rep1_color = 'green';
			$rep1 = 'ok';
			
			$res += 1;
		}
		else
		{
			$mess_rep1 = 'Ce n\'était pas ce mot là ! La réponse était : "François Rabellais"';
			$rep1_color = 'red';
			$rep1 = 'ok';
		}
	}
	if( isset($_POST['rep2']) )
	{
		$rep2 = $_POST['rep2'];
		
		if( $rep2 == 'Paul Verlaine' || $rep2 == 'paul verlaine' )
		{
			$mess_rep2 = 'Correct ! C\'était bien ça !';
			$rep2_color = 'green';
			$rep2 = 'ok';
			
			$res += 1;
		}
		else
		{
			$mess_rep2 = 'Ce n\'était pas ce mot là ! La réponse était : "Paul Verlaine"';
			$rep2_color = 'red';
			$rep2 = 'ok';
		}
	}
	if( isset($_POST['rep3']) )
	{
		$rep3 = $_POST['rep3'];
		
		if( $rep3 == 'Boris Vian' || $rep3 == 'Boris Vian' )
		{
			$mess_rep3 = 'Correct ! C\'était bien ça !';
			$rep3_color = 'green';
			$rep3 = 'ok';
			
			$res += 1;
		}
		else
		{
			$mess_rep3 = 'Ce n\'était pas ce mot là ! La réponse était : "Boris Vian"';
			$rep3_color = 'red';
			$rep3 = 'ok';
		}
	}
	if( isset($_POST['rep4']) )
	{
		$rep4 = $_POST['rep4'];
		
		if( $rep4 == 'C\'est cong comme lalune' || $rep4 == 'C\'est con comme la lune' || $rep4 == 'c\'est cong comme lalune' || $rep4 == 'c\'est con comme la lune' )
		{
			$mess_rep4 = 'Correct ! C\'était bien ça !';
			$rep4_color = 'green';
			$rep4 = 'ok';
			
			$res += 1;
		}
		else
		{
			$mess_rep4 = 'Ce n\'était pas ce mot là ! La réponse était : "C\'est con comme la lune (C\'est cong comme lalune)"';
			$rep4_color = 'red';
			$rep4 = 'ok';
		}
	}
	if( isset($_POST['rep5']) )
	{
		$rep5 = $_POST['rep5'];
		
		if( $rep5 == 'La buvette est plaine de couillon' || $rep5 == 'la buvette est plaine de couillon' )
		{
			$mess_rep5 = 'Correct ! C\'était bien ça !';
			$rep5_color = 'green';
			$rep5 = 'ok';
			
			$res += 1;
		}
		else
		{
			$mess_rep5 = 'Ce n\'était pas ce mot là ! La réponse était : "La buvette est plaine de couillon"';
			$rep5_color = 'red';
			$rep5 = 'ok';
		}
	}
	if( isset($_POST['rep6']) )
	{
		$rep6 = $_POST['rep1'];
		
		if( $rep6 == 'Quel temps de cochon' || $rep6 == 'Quel tamp de cochon' || $rep6 == 'quel temps de cochon' || $rep6 == 'quel tamp de cochon' )
		{
			$mess_rep6 = 'Correct ! C\'était bien ça !';
			$rep6_color = 'green';
			$rep6 = 'ok';
			
			$res += 1;
		}
		else
		{
			$mess_rep6 = 'Ce n\'était pas ce mot là ! La réponse était : "Quel temps de cochon (Quel tamp de cochon)"';
			$rep6_color = 'red';
			$rep6 = 'ok';
		}
	}
	if( isset($_POST['rep7']) )
	{
		$rep7 = $_POST['rep7'];
		
		if( $rep7 == 'Anthitèse' )
		{
			$mess_rep7 = 'Correct ! C\'était bien une <font color="'.$rep7_color.'">anthitèse</font>';
			$rep7_color = 'green';
			$rep7 = 'ok';
			
			$res += 1;
		}
		else
		{
			$mess_rep7 = 'Ce n\'était pas ce mot là ! La réponse était : "Anthitèse"';
			$rep7_color = 'red';
			$rep7 = 'ok';
		}
	}
	if( isset($_POST['rep8']) )
	{
		$rep8 = $_POST['rep8'];
		
		if( $rep8 == 'Anaphore' )
		{
			$mess_rep8 = 'Correct ! C\'était bien une <font color="'.$rep8_color.'">anaphore</font> !';
			$rep8_color = 'green';
			$rep8= 'ok';
			
			$res += 1;
		}
		else
		{
			$mess_rep8 = 'Ce n\'était pas ce mot là ! La réponse était : "Anaphore"';
			$rep8_color = 'red';
			$rep8 = 'ok';
		}
	}
	if( isset($_POST['rep9']) )
	{
		$rep9 = $_POST['rep9'];
		
		if( $rep9 == 'Hyperbole' )
		{
			$mess_rep9 = 'Correct ! C\'était bien une <font color="'.$rep9_color.'">hyperbole</font> !';
			$rep9_color = 'green';
			$rep9 = 'ok';
			
			$res += 1;
		}
		else
		{
			$mess_rep9 = 'Ce n\'était pas ce mot là ! La réponse était : "Hyperbole"';
			$rep9_color = 'red';
			$rep9 = 'ok';
		}
	}
	if( isset($_POST['rep10']) )
	{
		$rep10 = $_POST['rep10'];
		
		if( $rep10 == 'Anacoluthe' )
		{
			$mess_rep10 = 'Correct ! C\'était bien une <font color="'.$rep10_color.'">anacoluthe</font> !';
			$rep10_color = 'green';
			$rep10 = 'ok';
			
			$res += 1;
		}
		else
		{
			$mess_rep10 = 'Ce n\'était pas ce mot là ! La réponse était : "Anacoluthe"';
			$rep10_color = 'red';
			$rep10 = 'ok';
		}
	}
	
	if( isset($_GET['act']) )
	{
		$res = ($res/10)*100;
		$pt_ex = round(100*$res)/100;
		
		$res = $resultat['Jeux de mots'] + $res;
		
		$resultat['Jeux de mots'] = $res;
		
		$resultat['Pourc_jdm'] = $resultat['Jeux de mots'] / $resultat['Nb_jdm'];
		
		
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
	
?>
<div id="content">
	<div class="content">
		<ul>
			<li>
				<form method="post" action="index.php?page=exe&type=jdm&act=cor">
				<div class="center_form">Recomposez les pseudonymes d'auteurs célèbres :</div>
				<br>
<?php
				if( isset($rep1) && $rep1 == "ok" )
				{
					echo ' Alcofribas Nasier -> <font color="'.$rep1_color.'">François Rabelais</font><br>';
				}
				else
				{
?>
					Alcofribas Nasier -> <input class="center_form" type=text" name="rep1" /><br>
<?php
				}
				if( isset($mess_rep1) && $mess_rep1 != '' )
				{
					echo '	<div class="message">';
					echo $mess_rep1;
					echo ' </div>';
				}
				if( isset($rep2) && $rep2 == "ok" )
				{
					echo ' Pauvre Lélian -> <font color="'.$rep2_color.'">Paul Verlaine</font><br>';
				}
				else
				{
?>
				Pauvre Lélian -> <input class="center_form" type=text" name="rep2" /><br>
<?php
				}
				if( isset($mess_rep2) && $mess_rep2 != '' )
				{
					echo '	<div class="message">';
					echo $mess_rep2;
					echo ' </div>';
				}
				if( isset($rep3) && $rep3 == "ok" )
				{
					echo ' Bison Ravi -> <font color="'.$rep3_color.'">Boris Vian</font><br>';
				}
				else
				{
?>
				Bison Ravi -> <input class="center_form" type=text" name="rep3" /><br>
<?php			}	
				if( isset($mess_rep3) && $mess_rep3 != '' )
				{
					echo '	<div class="message">';
					echo $mess_rep3;
					echo ' </div>';
				}
?>
				<br>
				<br>
				<div class="center_form">Utilisez la contrepètrie pour créer de nouvelles phrases :</div>
				<br>
<?php
				if( isset($rep4) && $rep4 == "ok" )
				{
					echo ' C\'est long comme lacune -> <font color="'.$rep4_color.'">C\'est con comme la lune (C\'est cong comme lalaune)</font><br>';
				}
				else
				{
?>
				C'est long comme lacune -> <input class="center_form" type=text" name="rep4" /><br>
<?php
				}
				if( isset($mess_rep4) && $mess_rep4 != '' )
				{
					echo '	<div class="message">';
					echo $mess_rep4;
					echo ' </div>';
				}
				if( isset($rep5) && $rep5 == "ok" )
				{
					echo ' La cuvette est pleine de bouillon -> <font color="'.$rep5_color.'">La buvette est pleine de couillon</font><br>';
				}
				else
				{
?>
				La cuvette est pleine de bouillon -> <input class="center_form" type=text" name="rep5" /><br>
<?php
				}
				if( isset($mess_rep5) && $mess_rep5 != '' )
				{
					echo '	<div class="message">';
					echo $mess_rep5;
					echo ' </div>';
				}
				if( isset($rep6) && $rep6 == "ok" )
				{
					echo ' Quel champ de coton -> <font color="'.$rep6_color.'">Quel temps de cochon (Quel tamp de cochon)</font>';
				}
				else
				{
?>
				Quel champ de coton -> <input class="center_form" type=text" name="rep6" /><br>
<?php
				}
				if( isset($mess_rep6) && $mess_rep6 != '' )
				{
					echo '	<div class="message">';
					echo $mess_rep6;
					echo ' </div>';
				}
?>
				<br>
				<br>
				<div class="center_form">Retrouvez le jeux de mots utilisé dans ces phrases :</div>
				<br>
				<div class="citation">
				"[...]Les deux hommes étaient, l'un une espèce de géant, l'autre une espèce de nain[...]"
				</div>
				<div class="ref">Victor Hugo, <i>Qutre-Vingt-Treize</i></div>
<?php
				if( isset($rep7) && $rep7 == "ok" )
				{
					echo '	<div class="message">';
					echo $mess_rep7;
					echo ' </div>';
				}
				else
				{
?>
				<select class="select" name="rep7">
					<option>
						Anagramme
					</option>
					<option>
						Contrepètrie
					</option>
					<option>
						Antithèse
					</option>
					<option>
						Oxymore
					</option>
					<option>
						Hyperbole
					</option>
					<option>
						Gradation
					</option>
					<option>
						Anacoluthe
					</option>
					<option>
						Anaphore
					</option>
				</select>
<?php			}	?>
				<br>
				<div class="citation">
				"[...]Ceux qui vivent, ce sont ceux qui luttent, ce sont<br>
				Ceux dont un dessein ferm emplit l'âme et le front<br>
				Ceux qui d'un haut destin gravissent l'âpre cime,<br>
				Ceux qui marchent pensifs, épris d'un but sublime,[...]"<br>
				</div>
				<div class="ref">Victor Hugo, <i>Les Châtiments</i></div>
<?php
				if( isset($rep8) && $rep8 == "ok" )
				{
					echo '	<div class="message">';
					echo $mess_rep8;
					echo ' </div>';
				}
				else
				{
?>
				<select class="select" name="rep8">
					<option>
						Anagramme
					</option>
					<option>
						Contrepètrie
					</option>
					<option>
						Antithèse
					</option>
					<option>
						Oxymore
					</option>
					<option>
						Hyperbole
					</option>
					<option>
						Gradation
					</option>
					<option>
						Anacoluthe
					</option>
					<option>
						Anaphore
					</option>
				</select>
<?php			}	?>
				<br>
				<div class="citation">
				"[...]le moyen de ne pas vous parler de la plus belle, de la plus magnifique et de la plus trimphante pompe funèbre qui ait jamais été faite depuis qu'il y a des mortel ? [...]
				</div>
				<div class="ref">Madame de Sévigne, <i>Lettres</i></div>
<?php
				if( isset($rep9) && $rep9 == "ok" )
				{
					echo '	<div class="message">';
					echo $mess_rep9;
					echo ' </div>';
				}
				else
				{
?>
				<select class="select" name="rep9">
					<option>
						Anagramme
					</option>
					<option>
						Contrepètrie
					</option>
					<option>
						Antithèse
					</option>
					<option>
						Oxymore
					</option>
					<option>
						Hyperbole
					</option>
					<option>
						Gradation
					</option>
					<option>
						Anacoluthe
					</option>
					<option>
						Anaphore
					</option>
				</select>
<?php			}	?>
				<br>
				<div class="citation">
				"[...]Après boire, l'homme qui regarde la table et qui soupire, c'est qu'il va parler. [...]
				</div>
				<div class="ref">Jean Giono, <i>Un de Baumugnes</i></div>
<?php
				if( isset($rep10) && $rep10 == "ok" )
				{
					echo '	<div class="message">';
					echo $mess_rep10;
					echo ' </div>';
				}
				else
				{
?>
				<select class="select" name="rep10">
					<option>
						Anagramme
					</option>
					<option>
						Contrepètrie
					</option>
					<option>
						Antithèse
					</option>
					<option>
						Oxymore
					</option>
					<option>
						Hyperbole
					</option>
					<option>
						Gradation
					</option>
					<option>
						Anacoluthe
					</option>
					<option>
						Anaphore
					</option>
				</select>
				<br>
				<br>
				<br>
<?php			}	
				if( !isset($_GET['act']) )
				{
					echo ' <input class="center_form" type="submit" name="valider" value="Correction" />';
				}
				else
				{
					echo ' Résultat : '.$pt_ex.'%';
				}
?>
			</li>
		</ul>
    </div>
</div>