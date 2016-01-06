<?php
session_start(); 

header('Content-type: text/html; charset=UTF-8');
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Teach le français</title>
	<link href="includes/css/MiseEnPage.css" rel="stylesheet" type="text/css" />
	<link rel="icon" type="image/png" href="includes/images/minilogo.png">
</head>
<body>

<?php
if(isset($_SESSION['pseudo']) && $_SESSION['pseudo'] == "Admin") 
{
	try{
		// On se connecte à MySQL
		$pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		$bdd = new PDO('mysql:host=localhost;dbname=francais', 'root', '', $pdo_options);
    
		// On récupère tout le contenu de la table user
		$user = $bdd->query('SELECT * FROM user');

		echo '	  <div id="background">';
		echo '			  <div id="page">';
		echo '					 <div class="header">';
		echo '						<div class="footer">';
		echo '							<div class="body">';
		echo '								<div id="sidebar">';
												include("includes/col_gauche.php");
		echo '								</div>';
							
		echo '								<div id="content" >';
												if( isset($_GET['admin']) && $_GET['admin'] == 'user')
												{
													include("includes/admin/usr.php");
												}
												if( isset($_GET['admin']) && $_GET['admin'] == 'cor')
												{
													include("includes/admin/correction.php");
												}
		echo '								</div>';
		echo '							</div>';
		echo '						</div>';
		echo '					<div class="shadow">&nbsp;</div>';
		echo '			  </div>';
		echo '	  </div>';
	}
	catch(Exception $e)
	{
		// En cas d'erreur précédemment, on affiche un message et on arrête tout
		die('Erreur : '.$e->getMessage());
	}
}
else
{
	echo '	  <div id="background">';
	echo '			  <div id="page">';
	echo '					 <div class="header">';
	echo '						<div class="footer">';
	echo '							<div class="body">';
	echo '								<div id="sidebar">';
											include("includes/col_gauche.php");
	echo '								</div>';
	echo ' 								<div id="content">';
	echo '									<div class="content">';
	echo '										<ul class="article">';
	echo '											<li class="message">';
	echo '												Vous n\'avez pas les droits d\'accès pour accéder à cette page ...';
	echo '											</li>';
	echo '											<li class="precedent">';
	echo '												<a href="index.php" >&laquo; retour à l\'accueil</a>';
	echo '											</li>';
	echo '										</ul>';
	echo '									</div>';
	echo ' 								</div>';
	echo '							</div>';
	echo '						</div>';
	echo '					 <div class="shadow">&nbsp;</div>';
	echo '			  </div>';
	echo '	  </div>';
}
?>
</body>
</html>