<div id="content">
	<div class="content">
		<ul>
			<li>
<?php
	/*
		********************************************************************************************
		CONFIGURATION
		********************************************************************************************
	*/
	// destinataire est votre adresse mail. Pour envoyer à plusieurs à la fois, séparez-les par une virgule
	$destinataire = 'dieter.stinglhamber@gmail.com';

	// copie ? (envoie une copie au visiteur)
	$copie = 'oui';

	// Action du formulaire (si votre page a des paramètres dans l'URL)
	// si cette page est index.php?page=contact alors mettez index.php?page=contact
	// sinon, laissez vide
	if( isset($_SESSION['login']) )
	{
		$form_action = 'index.php?page=contact';
	}
	else
	{
		$form_action = 'login.php?page=contact';
	}

	// Messages de confirmation du mail
	$message_envoye = "Votre message nous est bien parvenu !";
	$message_non_envoye = "L'envoi du mail a échoué, veuillez réessayer SVP.";

	// Message d'erreur du formulaire
	$message_formulaire_invalide = "Vérifiez que tous les champs soient bien remplis et que l'email soit sans erreur.";

	/*
		********************************************************************************************
		FIN DE LA CONFIGURATION
		********************************************************************************************
	*/

	/*
	 * cette fonction sert à nettoyer et enregistrer un texte
	 */
	function Rec($text)
	{
		$text = trim($text); // delete white spaces after & before text
		if (1 === get_magic_quotes_gpc())
		{
			$stripslashes = create_function('$txt', 'return stripslashes($txt);');
		}
		else
		{
			$stripslashes = create_function('$txt', 'return $txt;');
		}

		// magic quotes ?
		$text = $stripslashes($text);
		$text = htmlspecialchars($text, ENT_QUOTES); // converts to string with " and ' as well
		$text = nl2br($text);
		return $text;
	};

	/*
	 * Cette fonction sert à vérifier la syntaxe d'un email
	 */
	function IsEmail($email)
	{
		$pattern = "^([a-z0-9_]|\\-|\\.)+@(([a-z0-9_]|\\-)+\\.)+[a-z]{2,7}$";
		return (preg_match($pattern,$email)) ? false : true;
	};

	$err_formulaire = false; // sert pour remplir le formulaire en cas d'erreur si besoin

	// si formulaire envoyé, on récupère tous les champs. Sinon, on initialise les variables.
	$nom     = (isset($_POST['nom']))     ? Rec($_POST['nom'])     : '';
	$email   = (isset($_POST['email']))   ? Rec($_POST['email'])   : '';
	$objet   = (isset($_POST['objet']))   ? Rec($_POST['objet'])   : '';
	$message = (isset($_POST['message'])) ? Rec($_POST['message']) : '';

	if (isset($_POST['envoi']))
	{
		// On va vérifier les variables et l'email ...
		$email = (IsEmail($email)) ? $email : ''; // soit l'email est vide si erroné, soit il vaut l'email entré
		$err_formulaire = (IsEmail($email)) ? false : true;

		if (($nom != '') && ($email != '') && ($objet != '') && ($message != ''))
		{
			// les 4 variables sont remplies, on génère puis envoie le mail
			$headers = 'From: '.$nom.' <'.$email.'>' . "\r\n";

			// envoyer une copie au visiteur ?
			if ($copie == 'oui')
			{
				$cible = $destinataire.','.$email;
			}
			else
			{
				$cible = $destinataire;
			};

			// Remplacement de certains caractères spéciaux
			$message = html_entity_decode($message);
			$message = str_replace('&#039;',"'",$message);
			$message = str_replace('&#8217;',"'",$message);
			$message = str_replace('<br>','',$message);
			$message = str_replace('<br />','',$message);

			// Envoi du mail
			if (mail($cible, $objet, $message, $headers))
			{
				echo '<p>'.$message_envoye.'</p>'."\n";
			}
			else
			{
				echo '<p>'.$message_non_envoye.'</p>'."\n";
			};
		}
		else
		{
			// une des 3 variables (ou plus) est vide ...
			echo '<p>'.$message_formulaire_invalide.' <a href="contact.php">Retour au formulaire</a></p>'."\n";
			$err_formulaire = true;
		};
	}; // fin du if (!isset($_POST['envoi']))

	if (($err_formulaire) || (!isset($_POST['envoi'])))
	{
		// afficher le formulaire
		echo '<form class="center_form" id="contact" method="post" action="'.$form_action.'">'."\n";
		echo '	<fieldset><legend>Vos coordonnées</legend>'."\n";
		echo '		<p>'."\n";
		echo '			<label for="nom">Nom :</label>'."\n";
						if( !isset($_SESSION['pseudo']) )
						{
		echo '			<input class="center_form" type="text id="nom" name="nom" value="'.stripslashes($nom).'" tabindex="1" />'."\n";
		echo '		</p>'."\n";
		echo '		<p>'."\n";
		echo '			<label for="email">Email :</label>'."\n";
		echo '			<input class="center_form" type="text id="email" name="email" value="'.stripslashes($email).'" tabindex="2" />'."\n";
						}
						else
						{
		echo '			<input class="center_form" type="text id="nom" name="nom" value="'.stripslashes($_SESSION['nom']).'" tabindex="1" />'."\n";
		echo '		</p>'."\n";
		echo '		<p>'."\n";
		echo '			<label for="email">Email :</label>'."\n";
		echo '			<input class="center_form" type="text id="email" name="email" value="'.stripslashes($_SESSION['mail']).'" tabindex="2" />'."\n";				
						}
		echo '		</p>'."\n";
		echo '	</fieldset>'."\n";
		echo ' <br> ';
		echo '	<fieldset><legend>Votre message :</legend>'."\n";
		echo '		<p>'."\n";
		echo '			<label for="objet">Objet :</label>'."\n";
		echo '			<input class="center_form" type="text id="objet" name="objet" value="'.stripslashes($objet).'" tabindex="3" />'."\n";
		echo '		</p>'."\n";
		echo '		<p>'."\n";
		echo '			<label for="message">Message :</label>'."\n";
		echo '			<textarea id="message" name="message" tabindex="4" cols="30" rows="8">'.stripslashes($message).'</textarea>'."\n";
		echo '		</p>'."\n";
		echo '	</fieldset>'."\n";
		echo ' <br> ';
		echo '	<div style="text-align:center;"><input class="bouton" type="submit" name="envoi" value="Envoyer le formulaire !" /></div>'."\n";
		echo '</form>'."\n";
	};
?>
			</li>
		</ul>
	</div>
</div>