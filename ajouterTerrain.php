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
if (isset($_SESSION['terrain'])) {
	$terrain = $_SESSION['terrain'];
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
		  if (document.form1.libelle.value == "") {
		    alert("Le libelle est obligatoire");
		    document.form1.libelle.focus();
		    return false;
		  }

		  if (document.form1.type.value == "") {
		    alert("Le type est obligatoire");
		    document.form1.type.focus();
		    return false;
		  }

		  form1.submit();
		  return true;
		}
	</script>

  </head>

  <body>

	<form name="form1" method="POST" action="EnregistrerTerrain.php">
		<?php
		if (isset($_SESSION['messageErreur'])) {
			$messageErreur = $_SESSION['messageErreur'];
		   	echo "<br /><br />";
		   	echo '<div style="color: red; font-weight: bold;"><img src="images/alert16.gif" style="border: 0px" alt="alerte"/>'.$messageErreur.'</div>';
		   	echo "<br /><br />";
		   	unset($_SESSION['messageErreur']);
		}
		?>
		<input type="hidden" name="mode" value="<?php if (!isset($terrain)) { echo 'creation'; } else { echo 'modif'; }?>"/>
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
				  <td align="right" >Libelle</td>
				  <td align="left">
				  	<?php if (!isset($terrain)) {?>
				  	<input type="text" id="libelle" name="libelle" size="40" maxlength="50" value=""/>
				  	<?php } else {?>
				  	<input type="hidden" id="libelleInit" name="libelleInit" value="<?php echo $terrain->getLibelle(); ?>"/>
				  	<input type="text" id="libelle" name="libelle" size="40" maxlength="50" value="<?php echo $terrain->getLibelle(); ?>"/>
				  	<?php } ?>
				  </td>
				</tr>
			    <tr>
				  <td align="right" >Type</td>
				  <td align="left">
				  	<?php if (!isset($terrain)) {?>
				  	<input type="text" id="type" name="type" size="10" maxlength="12" value=""/>
				  	<?php } else {?>
				  	<input type="text" id="type" name="type" size="10" maxlength="12" value="<?php echo $terrain->getType(); ?>"/>
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