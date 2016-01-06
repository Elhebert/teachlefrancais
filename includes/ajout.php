<?php

$cat = null;
$type = null;

if( isset($_POST['cat']) )
{
	$cat = $_POST['cat'];
}
if( isset($_POST['type']) )
{
	$type = $_POST['type'];
}

echo '	<div id="content">';
echo '	<div class="content">';
echo '		<ul>';
echo '			<li>';
echo '				<fieldset>';
echo '					<legend>Catégorie</legend>';
						if( !isset($_POST['cat']) )
						{
echo '						<form method="post" action="index.php?page=ajout&cat='.$_POST['cat'].'">';
					
echo '						<select class="select" name="cat" size="1">';
echo '							<option name="info">';
echo '								Informatique';
echo '							</option>';
echo '							<option name="jdm">';
echo '								Jeux avec les mots';
echo '							</option>';
echo '							<option name="rheto">';
echo '								Figures rhétoriques';
echo '							</option>';
echo '						</select>';
						
echo '						<input class="center_form" type="submit" name="valider" value="Continuer" />';
						
echo '						</form>';
						}
						else
						{
echo '						<h2>'.$_POST['cat'].'</h2>';
						}
echo '				</fieldset>';
echo '			</li>';
echo '			<li>';
echo '				<fieldset>';
echo '					<legend>Type</legend>';
						if( isset($cat) && !isset($_POST['type']) )
						{
							if( $cat == "info" )
							{	
echo '							<form method="post" action="index.php?page=ajout&cat='.$cat.'&type='.$_POST['type'].'">';

echo '							<input type="radio" value="H" name="type"> Homophones';
echo '							 - ';
echo '							<input type="radio" value="O" name="type"> Orthographe';
echo '							 - ';
echo '							<input type="radio" value="O" name="type"> Vocabulaire';

echo '							<input class="bouton" type="submit" name="valider" value="Continuer" />';

echo '							</form>';
							}
						}
						else
						{
echo '						<h2>'.$_POST['type'].'</h2>';
						}
echo '				</fieldset>';
echo '			</li>';
echo '			<li>';
echo '				<fieldset>';
echo '					<legend>Exercice</legend>';
						if( isset($cat) && isset($type) )
						{
echo '						<form method="post" action="index.php?page=ajout&cat='.$cat.'&type='.$type.'&exo=ok">';

							if( $cat == "info" )
							{
								if( $type == "O" )
								{
echo '								<textarea name="exo" tabindex="4" cols="50" rows="10"><br>';
echo '								</textarea>';
								}
								if( $type == "H" )
								{
echo '								Homophone : ';
echo '								<input class="center_form" type="text" name="mot_hphone" /><br>';
echo '								Phrase : ';
echo '								<input class="center_form" type="text" name="phrase_hphone" /><br>';			
								}
								if( $type == "V" )
								{
echo '								Mot : ';
echo '								<input class="center_form" type="text" name="mot_voc" /><br>';
echo '								Définition : ';
echo '								<input class="center_form" type="text" name="def_voc" /><br>';
								}
							}
							if( $cat == "jdm" )
							{
echo '								Jeu de mot : ';
echo '								<input class="center_form" type="text" name="mot_jdm" /><br>';
echo '								Exemple : ';
echo '								<input class="center_form" type="text" name="ex_jdm" /><br>';
							}
							if( $cat == "rheto" )
							{
echo '								Figure rhétorique : ';
echo '								<input class="center_form" type="text" name="mot_rheto" /><br>';
echo '								Exemple : ';
echo '								<input class="center_form" type="text" name="ex_rheto" /><br>';
							}
							
echo '							<input class="bouton" type="submit" name="valider" value="Continuer" />';							

echo '						</form>';						
						}
echo '				</fieldset>';
echo '			</li>';
echo '		</ul>';
echo '    </div>';
echo '	</div>';
?>