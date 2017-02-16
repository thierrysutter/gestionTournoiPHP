<?php
function chargerClasse($classe) {
	require $classe . '.class.php'; // On inclut la classe correspondante au paramètre passé.
}

spl_autoload_register('chargerClasse'); // On enregistre la fonction en autoload pour qu'elle soit appelée dès qu'on instanciera une classe non déclarée.

ob_start();
session_start();
if (!isset($_SESSION['session_started'])) {
	header("location:index.php");
}
if (isset($_GET['idClub'])) {
	$idClub = $_GET['idClub'];
}
if (isset($_SESSION['contact'])) {
	$contact = $_SESSION['contact'];
}
?>

<!DOCTYPE html>
<html lang="fr">
  <head>
	<link rel="stylesheet" type="text/css" href="css/gestionTournoi.css" />
	<link rel="stylesheet" type="text/css" href="css/menu.css" />
	<link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />

	<script type="text/javascript" src="js/jquery/jquery-1.9.1.js"></script>
	<script type="text/javascript" src="js/jquery/jquery.dataTables.min.js"></script>
	<script type="text/javascript" src="js/jquery/jquery-ui.js"></script>

	<script type="text/javascript">
		$(document).ready(function(){
			$("#btnValider").button().click(function(e) {
				e.preventDefault();
				return valideForm();
			});

			$("#btnEffacer").button().click(function(e) {
				e.preventDefault();
				document.form1.reset();
				return false;
			});
		});

		function valideForm() {
		  if (document.form1.fonction.value == "") {
		    alert("La fonction est obligatoire");
		    document.form1.fonction.focus();
		    return false;
		  }

		  if (document.form1.tel.value == "") {
		    alert("Le n° de téléphone est obligatoire");
		    document.form1.tel.focus();
		    return false;
		  }

		  form1.submit();
		  return true;
		}
	</script>

  </head>

  <body>

	<form name="form1" method="POST" action="EnregistrerContact.php">
		<?php
		if (isset($_SESSION['messageErreur'])) {
			$messageErreur = $_SESSION['messageErreur'];
		   	echo "<br /><br />";
		   	echo '<div style="color: red; font-weight: bold;"><img src="images/alert16.gif" style="border: 0px" alt="alerte"/>'.$messageErreur.'</div>';
		   	echo "<br /><br />";
		   	unset($_SESSION['messageErreur']);
		}
		?>

		<input type="hidden" name="mode" value="<?php if (!isset($contact)) { echo 'creation'; } else { echo 'modif'; }?>"/>
		<input type="hidden" name="idClub" value="<?php echo $idClub; ?>"/>

		<div style="margin-top: 25px;">
			<table class="tftable">
			  <thead>
			  	<tr>
			  	  <th colspan="2">Informations generales</th>
			  	</tr>
			  </thead>
			  <tbody>
				<tr>
				  <td align="right" >Fonction</td>
				  <td align="left">
				  	<?php if (!isset($contact)) {?>
				  	<input type="text" id="fonction" name="fonction" size="40" maxlength="50" value=""/>
				  	<?php } else {?>
				  	<input type="text" id="fonction" name="fonction" size="40" maxlength="50" value="<?php echo $contact->getFonction(); ?>"/>
				  	<?php } ?>
				  </td>
				</tr>
				<tr>
				  <td align="right" >Nom</td>
				  <td align="left">
				  	<?php if (!isset($contact)) {?>
				  	<input type="text" id="nom" name="nom" size="40" maxlength="50" value=""/>
					<?php } else {?>
					<input type="hidden" id="nomInit" name="nomInit" value="<?php echo $contact->getNom(); ?>"/>
				  	<input type="text" id="nom" name="nom" size="40" maxlength="50" value="<?php echo $contact->getNom(); ?>"/>
				  	<?php } ?>
				  </td>
				</tr>
				<tr>
				  <td align="right" >Prénom</td>
				  <td align="left">
				  	<?php if (!isset($contact)) {?>
				  	<input type="text" id="prenom" name="prenom" size="40" maxlength="50" value=""/>
				  	<?php } else {?>
				  	<input type="text" id="prenom" name="prenom" size="40" maxlength="50" value="<?php echo $contact->getPrenom(); ?>"/>
				  	<?php } ?>
				  </td>
				</tr>
				<tr>
		    	  <td align="right">Adresse</td>
		    	  <td align="left">
		    	  <?php if (!isset($contact)) {?>
				  	<input type="text" id="adresse" name="adresse" size="40" maxlength="50" value=""/><br/>
		    	  	<input type="text" id="adresse2" name="adresse2" size="40" maxlength="50" value=""><br/>
		    	  	<input type="text" id="adresse3" name="adresse3" size="40" maxlength="50" value="">
		    	  	<?php } else {?>
				  	<input type="text" id="adresse" name="adresse" size="40" maxlength="50" value="<?php echo $contact->getAdresse1(); ?>"/>
				  	<input type="text" id="adresse2" name="adresse2" size="40" maxlength="50" value="<?php echo $contact->getAdresse2(); ?>"/>
				  	<input type="text" id="adresse3" name="adresse3" size="40" maxlength="50" value="<?php echo $contact->getAdresse3(); ?>"/>
				  	<?php } ?>
				  </td>
				</tr>
				<tr>
				  <td align="right" >Code postal</td>
		    	  <td align="left">
		    	  <?php if (!isset($contact)) {?>
				  	<input type="text" id="codePostal" name="codePostal" size="8" maxlength="10" value="">
				  	<?php } else {?>
				  	<input type="text" id="codePostal" name="codePostal" size="8" maxlength="10" value="<?php echo $contact->getCodePostal(); ?>"/>
				  	<?php } ?>
				  </td>
				</tr>
				<tr>
				  <td align="right" >Ville</td>
		    	  <td align="left">
		    	  <?php if (!isset($contact)) {?>
				  	<input type="text" id="ville" name="ville" size="30" maxlength="50" value="">
				  	<?php } else {?>
				  	<input type="text" id="ville" name="ville" size="30" maxlength="50" value="<?php echo $contact->getVille(); ?>"/>
				  	<?php } ?>
				  </td>
				</tr>
				<tr>
			      <td align="right" >Pays</td>
			      <td align="left">
			      <?php if (!isset($contact)) {?>
				  	<input type="text" id="pays" name="pays" size="15" maxlength="50" value="">
				  	<?php } else {?>
				  	<input type="text" id="pays" name="pays" size="15" maxlength="50" value="<?php echo $contact->getPays(); ?>"/>
				  	<?php } ?>
				  </td>
			    </tr>
			    <tr>
				  <td align="right" >Tel</td>
				  <td align="left">
				  <?php if (!isset($contact)) {?>
				  	<input type="text" id="tel" name="tel" size="10" maxlength="12" value=""/>
				  	<?php } else {?>
				  	<input type="text" id="tel" name="tel" size="10" maxlength="12" value="<?php echo $contact->getTel(); ?>"/>
				  	<?php } ?>
				  </td>
				</tr>
				<tr>
		    	  <td align="right" >Email</td>
		    	  <td align="left">
		    	  <?php if (!isset($contact)) {?>
				  	<input type="text" id="email" name="email" size="40" maxlength="100" value=""/>
				  	<?php } else {?>
				  	<input type="text" id="email" name="email" size="40" maxlength="100" value="<?php echo $contact->getEmail(); ?>"/>
				  	<?php } ?>
				  </td>
		    	</tr>
			  </tbody>
			</table>
		</div>
		<div id="boutons" style="margin-top: 10px;">
			<input type="button" class="button" id="btnValider" value="Valider">
			<input type="reset" class="button" id="btnEffacer" value="Effacer">
		</div>

	</form>

  </body>
</html>
<?php
ob_end_flush();
?>