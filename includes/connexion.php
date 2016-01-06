<?php
// Indique le bon format des entêtes
@header('Content-type: text/html; charset=UTF-8');

/* Création d'une fonction qui teste la configuration get_magic_quotes_gpc du serveur.
Si oui, supprime avec la fonction stripslashes les antislashes "\" insérés dans les chaines de caractère des variables gpc (GET, POST, COOKIE) */
function Verif_magicquotes ($chaine) 
{
	if (get_magic_quotes_gpc()) 
		{
			$chaine = stripslashes($chaine);
		}
	return $chaine;
} 

// Initialisation du message de réponse
$message = null;


// Si le formulaire est envoyé
if (isset($_POST['Pseudo'])) 
{

    /* Récupération des variables issues du formulaire
    Teste l'existence les données post en vérifiant qu'elles existent, qu'elles sont non vides et non composées uniquement d'espaces.
    En cas de succès, on applique la fonction Verif_magicquotes pour (éventuellement) nettoyer la variable */
    $pseudo = (isset($_POST['Pseudo']) && trim($_POST['Pseudo']) != '')? Verif_magicquotes($_POST['Pseudo']) : null;
    $passwd = (isset($_POST['Passwd']) && trim($_POST['Passwd']) != '')? Verif_magicquotes($_POST['Passwd']) : null;
    

    // Si $Pseudo et $Passwd différents de null
    if(isset($pseudo,$passwd)) 
    {	
        $passwd = sha1($passwd);
		
		if(is_dir("includes/fichiers/".$pseudo) === true)
		{
			$fichier = "includes/fichiers/".$pseudo."/user.ini";
			
			// On vérifie si le fichier existe et si on arrive à le lire
			if(file_exists($fichier) && $fichier_lecture=file($fichier))
			{
				// On vérifie le mot de passe
				foreach($fichier_lecture as $ligne)
				{
					$ligne_propre=trim($ligne);
					// Si la ligne est celle du mot de passe
					if( strpos($ligne, 'Mail = ') === 0)
					{
						$mail = end(explode(' = ', $ligne, 2));
					}
					if( strpos($ligne, 'Nom = ') === 0)
					{
						$nom = end(explode(' = ', $ligne, 2));
					}
					if( strpos($ligne, 'Prenom = ') === 0)
					{
						$prenom = end(explode(' = ', $ligne, 2));
					}
					if( strpos($ligne, 'Passwd = ') === 0)
					{
						$passwd_lu=end(explode(' = ',$ligne,2));
					}
				}
				if( $passwd_lu == $passwd )
				{
					// Enregistre le pseudo dans la variable de session $_SESSION['pseudo']
					// qui donne au visiteur la possibilité de visiter les pages protégées.
					$_SESSION['pseudo'] = $pseudo;
					$_SESSION['mail'] = $mail;
					$_SESSION['nom'] = $prenom.' '.$nom;
					
					@header('Location: index.php');
					exit();
					
				}
				else
				{	// le mot de passe est incorrect
					$message = 'Le mot de passe est incorrect';
				}
			}
		}
		else
		{   // Le Pseudo est incorrect
			$message = 'Le pseudo est incorrect';
		} 
    }
    else 
    {  //au moins un des deux champs "Pseudo" ou "mot de passe" n'a pas été rempli
		$message = 'Les champs pseudo et mot de passe doivent être remplis.';
    }
}
?>

<img src="includes/images/bckgrnd.jpg" width="726" height="546" alt="" title="">
<div class="featured">
	<div class="header">
		<ul>
			<li class="first">
				<img src="includes/images/logo1.png" width="50" alt="" title="" >
			</li>
			<li class="last">
			<?php
			if( isset($message) && $message != '' )
			{
				echo '<br><p style="color:red; font-weight:bold;" class="message">'. $message.' </p>';
			}
			else
			{
			?>
			
			<p>
					Bienvenue sur le site TEACH le français...
			</p>
			<?php
			}
			?>
			</li>
		</ul>
	</div>

	
		<div class="body">
		<p>
		Veuillez vous connecter pour accéder au site et à votre espace personnel. Vous pouvez vous inscrire en cliquant <a href="login.php?page=regi">ici</a> !
		</p>
		<p>
			<form class="center_form" name="connection" method="post" action="login.php?page=home">
				<label>Pseudo :</label><br>
				<input class="center_form" type="text" name="Pseudo" /><br>
				<br>
				<label>Mot de passe :</label><br>
				<input class="center_form" type="password" name="Passwd" /><br>
				<br>
				<input class="bouton" type="submit" id="valider" name="connect" value="Se connecter" />
			</form>
		</p>
		</div>
</div>