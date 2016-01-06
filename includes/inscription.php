<?php
// Indique le bon format des entêtes
header('Content-type: text/html; charset=UTF-8');

/* Création d'une fonction - utilisée dans la récupération des variables - qui teste la configuration get_magic_quotes_gpc du serveur.
Si oui, supprime avec la fonction stripslashes les antislashes "\" insérés dans les chaines de caractère des variables gpc (GET, POST, COOKIE) */
function Verif_magicquotes ($chaine) 
{
if (get_magic_quotes_gpc()) $chaine = stripslashes($chaine);

return $chaine;
} 

function Age($date_nais)
{
    $arr1 = explode('-', $date_nais);
    $arr2 = explode('/', date('d/m/Y'));
		
    if(($arr1[1] < $arr2[1]) || (($arr1[1] == $arr2[1]) && ($arr1[0] <= $arr2[0])))
	{
		return $arr2[2] - $arr1[2];
	}
    else
	{
		return $arr2[2] - $arr1[2] - 1;
	}
}

// Initialisation du message de réponse
$message = null;

// Si le formulaire est envoyé
if (isset($_POST['Pseudo'])) 
{

    /* Récupération des variables issues du formulaire
    Teste l'existence des données post en vérifiant qu'elles existent, qu'elles sont non vides et non composées uniquement d'espaces.
    En cas de succès, on applique la fonction Verif_magicquotes pour (éventuellement) nettoyer la variable */
    $pseudo = (isset($_POST['Pseudo']) && trim($_POST['Pseudo']) != '')? Verif_magicquotes($_POST['Pseudo']) : null;
    $passwd = (isset($_POST['Passwd']) && trim($_POST['Passwd']) != '')? Verif_magicquotes($_POST['Passwd']) : null;
	$nom = (isset($_POST['Nom']) && trim($_POST['Nom']) != '')? Verif_magicquotes($_POST['Nom']) : null;
	$prenom = (isset($_POST['Prenom']) && trim($_POST['Prenom']) != '')? Verif_magicquotes($_POST['Prenom']) : null;
	$jour = (isset($_POST['Jour']) && trim($_POST['Jour']) != '')? Verif_magicquotes($_POST['Jour']) : null;
	$mois = (isset($_POST['Mois']) && trim($_POST['Mois']) != '')? Verif_magicquotes($_POST['Mois']) : null;
	$annee = (isset($_POST['Annee']) && trim($_POST['Annee']) != '')? Verif_magicquotes($_POST['Annee']) : null;
    $classe = (isset($_POST['Classe']) && trim($_POST['Classe']) != '')? Verif_magicquotes($_POST['Classe']) : null;
	$groupe = (isset($_POST['Groupe']) && trim($_POST['Groupe']) != '')? Verif_magicquotes($_POST['Groupe']) : null;
	$mail = (isset($_POST['Mail']) && trim($_POST['Mail']) != '')? Verif_magicquotes($_POST['Mail']) : null;
	$sexe = (isset($_POST['Sexe']) && trim($_POST['Sexe']) != '')? Verif_magicquotes($_POST['Sexe']) : null;
	$option = (isset($_POST['option']) && trim($_POST['option']) != '')? Verif_magicquotes($_POST['option']) : null;
	

    // Si $pseudo, $passwd, $nom, $prenom, $classe, $groupe, $mail, $jour, $mois, $annee et $sexe différents de null	
	if(isset($pseudo,$passwd,$nom,$prenom,$classe,$groupe,$option,$mail,$jour,$mois,$annee,$sexe)) 
    {
		$date_nais = $jour.'-'.$mois.'-'.$annee;
		$age = Age($date_nais);
		$annee_cours = $classe.' '.$option.' '.$groupe;
		
		$passwd = sha1($passwd);
		
		// On vérifie si le fichier existe et si on arrive à le lire
		if(is_dir("includes/fichiers/".$pseudo) === false)
		{
			mkdir("includes/fichiers/".$pseudo);
			// On ouvre le fichier user pour y ajouter l'utilisateur
			$fic_user = fopen("includes/fichiers/".$pseudo."/user.ini", 'a+');
			$fic_resultat = fopen("includes/fichiers/".$pseudo."/resultat.ini", 'a+');
			
			// On crée un groupe pour le nouvel utilisateur
			$user_info = 'Prenom = '.$prenom."\r\n".'Nom = '.$nom."\r\n".'Sexe = '.$sexe."\r\n".'Classe = '.$annee_cours."\r\n".'Date_nais = '.$date_nais."\r\n".'Age = '.$age."\r\n".'Mail = '.$mail."\r\n".'Passwd = '.$passwd;
			
			// On crée un groupe pour le nouvel utilisateur
			$resultat_info = 'Homophone = 0'."\r\n".'Nb_hphone = 0 '."\r\n".'Pourc_hphone = 0'."\r\n".'Orthographe = 0'."\r\n".'Nb_ortho = 0 '."\r\n".'Pourc_ortho = 0'."\r\n".'Vocabulaire = 0'."\r\n".'Nb_voc = 0 '."\r\n".'Pourc_voc = 0'.'Jeux de mots = 0'."\r\n".'Nb_jdm = 0 '."\r\n".'Pourc_jdm = 0'."\r\n".'Moyenne = 0'."\r\n".'Pourc_moy = 0';
			
			// On ajoute les infos et les résultats au fichier
			fwrite($fic_user, $user_info);
			fwrite($fic_resultat, $resultat_info);
			$message = 'Votre inscription est enregistrée. <a href = "login.php?page=home">Cliquez ici pour vous connecter</a>';
			
			// On ferme le fichier
			fclose($fic_resultat);
			fclose($fic_user);
		}
		else
		{   // Le pseudo est déjà utilisé
			$message = 'Ce pseudo est déjà utilisé, changez-le.';
		}
    }
    else 
    {   // Au moins un champ n'a pas été rempli
        $message = 'Tous les champs doivent être remplis.';
    }
}

echo '<div id="content">';
echo '	<div class="content">';
echo '		<form class="center_form" method="post" action="login.php?page=regi">';
echo '		<ul class="article">';
echo '			<li>';
echo '				<div class="center_form">Inscription</div>';
echo '			</li>';
echo '			<li>';
echo '				<div class="ref">';
echo '					<fieldset>';
echo '						<legend>Mes informations personnelles</legend>';
echo '							<label class="user_info" for="nom">Nom : </label>';
echo '							<input class="center_form" type="text" value="Nom" name="Nom"/><br>';
echo '							<label class="user_info" for="prenom">Prénom : </label>';
echo '							<input class="center_form" type="text" value="Prenom" name="Prenom"/><br>';
echo '							<label class="user_info" for"sexe">Sexe : </label>';
echo '							Homme : <input class="center_form" type="radio" value="H" name="Sexe"><br>Femme : <input class="center_form" type="radio" value="F" name="Sexe"><br>';
echo '							<label class="user_info" for="age">Date de naissance : </label>';
echo '							<input class="center_form" type="text" value="JJ" name="Jour" size="1">/<input class="center_form" type="text" value="MM" name="Mois" size="1">/<input class="center_form" type="text" value="AAAA" name="Annee" size="1"><br>';
echo '							<label class="user_info" for="classe">Classe : </label>';
echo '							<select class="select" name="Classe" size ="1"><option>1</option><option>2</option><option>3</option></select> <select class="select" name="option" size ="1"><option>TI</option><option>IG</option></select> <select class="select" name="Groupe" size ="1"><option>A</option><option>B</option><option>C</option><option>D</option><option>E</option><option>F</option></select><br>';
echo '					</fieldset>';
echo '				</div>';
echo '			</li>';
echo '			<br>';
echo '			<li>';
echo '				<div class="ref">';
echo '					<fieldset>';
echo '						<legend>Informations supplémentaires</legend>';		
echo '							<label class="user_info" for="mail">Adresse mail : </label>';
echo '							<input class="center_form" type="text" value="@" name="Mail" /><br>';
echo '							<label class="user_info" for="pseudo">Pseudo : </label>';
echo '							<input class="center_form" type="text" value="Pseudo" name="Pseudo" /><br>';
echo '							<label class="user_info" for="passwd">Mot de passe : </label>';
echo '							<input class="center_form" type="password" value="password" name="Passwd" /><br>';
echo '					</fieldset>';
echo '				</div>';
echo '			</li>';
echo '			<li>';

					if(isset($message)) 
					{
						echo '<div class="message">'.$message.'</div>';
					}
					echo '<input type = "submit" value = "Envoyer" id = "valider" />';
					
echo '			</li>';
echo '		</ul>';
echo '		</form>';
echo '	</div>';
echo '</div>';
?>