<a href="index.php?page=home"><img src="includes/images/logo.png" id="logo" width="157" height="74" alt="Logo"></a>

<ul class="navigation">
	<?php
		if(!isset($_SESSION['pseudo'])) 
		{
	?>
	<li <?php if( !isset($_GET['page']) || ( isset($_GET['page']) && $_GET['page'] == "home" )) { echo 'class="active"'; }?> ><a href="index.php?page=home">ACCUEIL</a></li>
	<li <?php if( isset($_GET['page']) && $_GET['page'] == "contact" ) {echo 'class="active"';} ?> class="last" ><a href="login.php?page=contact">CONTACT</a></li>
	<?php
		}
		else
		{
	?>
	<li <?php if( !isset($_GET['page']) || ( isset($_GET['page']) && $_GET['page'] == "home" )) { echo 'class="active"'; }?> ><a href="index.php?page=home">ACCUEIL</a></li>
	<li <?php if( isset($_GET['page']) && $_GET['page'] == "the" ) {echo 'class="active"';} ?>><a href="index.php?page=the">THEORIE</a></li>
	<li <?php if( isset($_GET['page']) && $_GET['page'] == "exe" ) {echo 'class="active"';} ?>><a href="index.php?page=exe">EXERCICES</a></li>
	<!-- <li <?php //if( isset($_GET['page']) && $_GET['page'] == "ctrl" ) {echo 'class="active"';} ?>><a href="index.php?page=ctrl">EVALUATION</a></li> -->
	<li <?php if( isset($_GET['page']) && $_GET['page'] == "user" ) {echo 'class="active"';} ?>><a href="index.php?page=user">MA PAGE</a></li>
	<li <?php if( isset($_GET['page']) && $_GET['page'] == "contact" ) {echo 'class="active"';} ?>><a href="index.php?page=contact">CONTACT</a></li>
	<li <?php if( isset($_GET['page']) && $_GET['page'] == "about" ) {echo 'class="active"';} ?>><a href="index.php?page=about">ABOUT</a></li>
	<li class="last" ><a href="logout.php">DECONNEXION</a></li>
	<?php
		}
		if(isset($_SESSION['pseudo']) && $_SESSION['pseudo'] == "Admin") 
		{
	?>
	<br><br>
	<li class="citation">ADMIN PANEL</li>
	<li <?php if( isset($_GET['admin']) && $_GET['admin'] == "user" ) {echo 'class="active"';} ?>><a href="admin.php?page=admin&admin=user">LISTE UTILISATEURS</a></li>
	<li <?php if( isset($_GET['admin']) && $_GET['admin'] == "cor" ) {echo 'class="active"';} ?>><a href="admin.php?page=admin&admin=cor">CORRECTION EVALUATION</a></li>
	<?php
		}
	?>
</ul>
<div class="connect">
	<a href="http://facebook.com/dieter.sting" class="facebook">&nbsp;</a>
	<a href="https://twitter.com/Elhebert" class="twitter">&nbsp;</a>
	<a href="https://plus.google.com/104040011086413915612/posts" class="google">&nbsp;</a>
</div>
	<?php
		if(!isset($_SESSION['pseudo'])) 
		{
	?>	
<div class="footer_col_gauche">
	<span><a href="login.php?page=contact">Dieter Stinglhamber</a> &copy; Copyright 2012.</span>
	<span><a href="login.php?page=contact">TEACH_LeFrançais</a> all rights reserved</span>
</div>
	<?php
		}
		else
		{
	?>
<div class="footer_col_gauche">
	<span><a href="index.php?page=contact">Dieter Stinglhamber</a> &copy; Copyright 2012.</span>
	<span><a href="index.php?page=contact">TEACH_LeFrançais</a> all rights reserved</span>
</div>
	<?php
		}
	?>