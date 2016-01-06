<?php
@session_start();@header('Content-type: text/html; charset=UTF-8');

if(!isset($_SESSION['pseudo'])){
	@header('Location:login.php');
}
else
{
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<?phpecho ' <html xmlns="http://www.w3.org/1999/xhtml">';
echo ' <head>';
echo ' 	<title>Teach le français</title>';
echo ' 	<link href="includes/css/MiseEnPage.css" rel="stylesheet" type="text/css" />';
echo ' 	<link rel="icon" type="image/png" href="includes/images/minilogo.png">';
echo ' </head>';
echo ' <body>';
echo ' 	<div id="background">';
echo ' 		<div id="page">';
echo ' 			<div class="header">';
echo ' 				<div class="footer">';
echo ' 					<div class="body">';
echo ' 						<div id="sidebar">';
 							include("includes/col_gauche.php");
echo ' 						</div>';
echo ' 						<div id="content" >';
								if( !isset($_GET['page']) || ( isset($_GET['page']) && $_GET['page'] == "home" ))
								{
									include("includes/main.php");
								}
								if( isset($_GET['page']) && $_GET['page'] == "the" )
								{
									if( !isset($_GET['the']) )
									{
										include("includes/theorie_fr.php");
									}
									else
									{
										if( isset($_GET['the']) && $_GET['the'] == "info" )
										{
											if( !isset($_GET['s']))
											{
												include("includes/theorie_info.php");
											}
											else
											{
												if( isset($_GET['s']) && $_GET['s'] == "serv" )
												{
													include("includes/theorie/serv.php");
												}
												if( isset($_GET['s']) && $_GET['s'] == "archpc" )
												{
													include("includes/theorie/archpc.php");
												}
												if( isset($_GET['s']) && $_GET['s'] == "lgpw" )
												{
													include("includes/theorie/lgpw.php");
												}
												if( isset($_GET['s']) && $_GET['s'] == "rout" )
												{
													include("includes/theorie/rout.php");
												}
												if( isset($_GET['s']) && $_GET['s'] == "fw" )
												{
													include("includes/theorie/firewall.php");
												}
												if( isset($_GET['s']) && $_GET['s'] == "int" )
												{
													include("includes/theorie/internet.php");
												}
												if( isset($_GET['s']) && $_GET['s'] == "cbl" )
												{
													include("includes/theorie/cable.php");
												}
											}
										}
										if( isset($_GET['the']) && $_GET['the'] == "jdm" )
										{
											include("includes/jeuxdemot.php");
										}
										if( isset($_GET['the']) && $_GET['the'] == "rheto" )
										{
											include("includes/rhetorique.php");
										}
									}
								}
								if( isset($_GET['page']) && $_GET['page'] == "exe" )
								{

									if( !isset($_GET['type']) )
									{
										include("includes/exercice.php");
									}
									else
									{
										if( isset($_GET['type']) && $_GET['type'] == "homophone")
										{
											if( !isset($_GET['exe']) )
											{
												include("includes/exercice/homophone.php");
											}
											else
											{
												if( isset($_GET['exe']) && $_GET['exe'] == "1")
												{
													include("includes/exercice/hphone/ex1hphone.php");
												}
												if( isset($_GET['exe']) && $_GET['exe'] == "2")
												{
													include("includes/exercice/hphone/ex2hphone.php");
												}
												if( isset($_GET['exe']) && $_GET['exe'] == "3")
												{
													include("includes/exercice/hphone/ex3hphone.php");
												}
											}
										}
										if( isset($_GET['type']) && $_GET['type'] == "ortho")
										{
											if( !isset($_GET['exe']) )
											{
												include("includes/exercice/orthographe.php");
											}
											else
											{
												if( isset($_GET['exe']) && $_GET['exe'] == "1")
												{
													include("includes/exercice/ortho/ex1ortho.php");
												}
												if( isset($_GET['exe']) && $_GET['exe'] == "2")
												{
													include("includes/exercice/ortho/ex2ortho.php");
												}
												if( isset($_GET['exe']) && $_GET['exe'] == "3")
												{
													include("includes/exercice/ortho/ex3ortho.php");
												}
											}
										}
										if( isset($_GET['type']) && $_GET['type'] == "voc")
										{
											if( !isset($_GET['exe']) )
											{
												include("includes/exercice/vocabulaire.php");
											}
											else
											{
												if( isset($_GET['exe']) && $_GET['exe'] == "1")
												{
													include("includes/exercice/voc/ex1voc.php");
												}
												if( isset($_GET['exe']) && $_GET['exe'] == "2")
												{
													include("includes/exercice/voc/ex2voc.php");
												}
												if( isset($_GET['exe']) && $_GET['exe'] == "3")
												{
													include("includes/exercice/voc/ex3voc.php");
												}
											}
										}
										if( isset($_GET['type']) && $_GET['type'] == "jdm" )
										{
											include("includes/exercice/jdm/ex1jdm.php");
										}
									}
								}
								if( isset($_GET['page']) && $_GET['page'] == "ctrl" )
								{
									include("includes/evaluation.php");
								}
								if( isset($_GET['page']) && $_GET['page'] == "ajout" )
								{
									include("includes/ajout.php");
								}
								if( isset($_GET['page']) && $_GET['page'] == "user" )
								{
									include("includes/userpage.php");
								}
								if( isset($_GET['page']) && $_GET['page'] == "contact" )
								{
									include("includes/contact.php");
								}
								if( isset($_GET['page']) && $_GET['page'] == "about" )
								{
									include("includes/about.php");
								}
echo ' 						</div>';
echo ' 					</div>';
echo ' 				</div>';
echo ' 			<div class="shadow">&nbsp;</div>';
echo ' 		</div>';
echo ' 	</div>';
echo ' </body>';
echo ' </html>';
}
?>
