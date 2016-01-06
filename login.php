<?php
@session_start();

if(isset($_SESSION['pseudo']))
{
	@header('Location: index.php');
}
else
{
	@header('Content-type: text/html; charset=UTF-8');
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Teach le français</title>
	<link href="includes/css/MiseEnPage.css" rel="stylesheet" type="text/css" />
	<link rel="icon" type="image/png" href="includes/images/minilogo.png">
</head>
<body>
	  <div id="background">
			<div id="page">
				<div class="header">
					<div class="footer">
						<div class="body">
							<div id="sidebar">
								<?php
									include("includes/col_gauche.php");
								?>
							</div>
							<div id="content" >
								<?php
								if( !isset($_GET['page']) || ( isset($_GET['page']) && $_GET['page'] == "home" ))
								{
									include("includes/connexion.php");
								}
								if( isset($_GET['page']) && $_GET['page'] == "regi" )
								{	
									include("includes/inscription.php");
								}
								if( isset($_GET['page']) && $_GET['page'] == "contact" )
								{
									include("includes/contact.php");
								}
							?>
						</div>
					</div>
				</div>
				<div class="shadow">
					&nbsp;
				</div>
			</div>    
	  </div>    
</body>
</html>
<?php
}
?>