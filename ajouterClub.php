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
		  if (document.form1.nom.value == "") {
		    alert("Le nom du club est obligatoire");
		    document.form1.nom.focus();
		    return false;
		  }

		  if (document.form1.numAffiliation.value == "") {
		    alert("Le n° d'affiliation est obligatoire");
		    document.form1.numAffiliation.focus();
		    return false;
		  }

		  form1.submit();
		  return true;
		}
	</script>

  </head>

  <body>
	<div>
	<?php
	  $menu="CLUBS";
	  $param="Création du club";
	  include("menu.php");
	?>
	</div>


	<form name="form1" method="POST" action="EnregistrerClub.php">
		<?php
		if (isset($_SESSION['messageErreur'])) {
			$messageErreur = $_SESSION['messageErreur'];
		   	echo "<br /><br />";
		   	echo '<div style="color: red; font-weight: bold;"><img src="images/alert16.gif" style="border: 0px" alt="alerte"/>'.$messageErreur.'</div>';
		   	echo "<br /><br />";
		   	unset($_SESSION['messageErreur']);
		}
		?>

		<input type="hidden" name="mode" value="creation"/>

		<div id="container">
			<div id="colonneG">
			<table class="tftable">
			  <thead>
			  	<tr>
			  	  <th colspan="2">Informations générales</th>
			  	</tr>
			  </thead>
			  <tbody>
				<tr>
				  <td align="right" >Nom du club</td>
				  <td align="left"><input type="text" id="nom" name="nom" size="40" maxlength="50" value=""/></td>
				</tr>
				<tr>
				  <td align="right" >N° affiliation</td>
				  <td align="left"><input type="text" id="numAffiliation" name="numAffiliation" size="10" maxlength="10" value=""></td>
				</tr>
				<tr>
				  <td align="right" >Ligue</td>
				  <td align="left"><input type="text" id="ligue" name="ligue" size="25" maxlength="50" value=""/></td>
				</tr>
				<tr>
				  <td align="right" >District</td>
				  <td align="left"><input type="text" id="district" name="district" size="25" maxlength="50" value=""></td>
				</tr>
				<tr>
			      <td align="right" >Logo</td>
			      <td align="left">
			      	<input type="text" id="logo" name="logo" size="40" maxlength="50" value=""/>
			      	<img src="images/disk16.gif" style="vertical-align: middle;"/>
			      </td>
			    </tr>
			    <tr>
			      <td align="right" >Site web</td>
			      <td align="left">http://<input type="text" id="siteWeb" name="siteWeb" size="40" maxlength="50" value=""></td>
			    </tr>
			    <tr>
				  <td align="right" >Stade</td>
				  <td align="left"><input type="text" id="stade" name="stade" size="40" maxlength="100" value=""/></td>
				</tr>
				<tr>
				  <td align="right" >Couleur 1</td>
				  <td align="left"><input type="text" id="couleur1" name="couleur1" size="20" maxlength="12" value=""/></td>
				</tr>
				<tr>
				  <td align="right" >Couleur 2</td>
				  <td align="left"><input type="text" id="couleur2" name="couleur2" size="20" maxlength="12" value=""></td>
				</tr>
			  </tbody>
			</table>
			</div>
			<div id="colonneG">
			<table class="tftable">
			  <thead>
			  	<tr>
			  	  <th colspan="2">Coordonnées principales</th>
			  	</tr>
			  </thead>
			  <tbody>
				<tr>
		    	  <td align="right">Adresse</td>
		    	  <td align="left">
		    	  <input type="text" id="adresse" name="adresse" size="40" maxlength="50" value=""/><br/>
		    	  <input type="text" id="adresse2" name="adresse2" size="40" maxlength="50" value=""><br/>
		    	  <input type="text" id="adresse3" name="adresse3" size="40" maxlength="50" value=""></td>
				</tr>
				<tr>
				  <td align="right" >Code postal</td>
		    	  <td align="left"><input type="text" id="codePostal" name="codePostal" size="8" maxlength="10" value=""></td>
				</tr>
				<tr>
				  <td align="right" >Ville</td>
		    	  <td align="left"><input type="text" id="ville" name="ville" size="30" maxlength="50" value=""></td>
				</tr>
				<tr>
			      <td align="right" >Pays</td>
			      <td align="left"><input type="text" id="pays" name="pays" size="15" maxlength="50" value=""></td>
			    </tr>
			    <tr>
				  <td align="right" >Tel 1</td>
				  <td align="left"><input type="text" id="tel1" name="tel1" size="10" maxlength="12" value=""/></td>
				</tr>
				<tr>
				  <td align="right" >Tel 2</td>
				  <td align="left"><input type="text" id="tel2" name="tel2" size="10" maxlength="12" value=""/></td>
				</tr>
				<tr>
				  <td align="right" >Fax 1</td>
		    	  <td align="left"><input type="text" id="fax1" name="fax1" size="10" maxlength="12" value=""/></td>
		    	</tr>
		    	<tr>
				  <td align="right" >Fax 2</td>
		    	  <td align="left"><input type="text" id="fax2" name="fax2" size="10" maxlength="12" value=""/></td>
		    	</tr>
		    	<tr>
		    	  <td align="right" >Email 1</td>
		    	  <td align="left"><input type="text" id="email1" name="email1" size="40" maxlength="100" value=""/></td>
		    	</tr>
		    	<tr>
		    	  <td align="right" >Email 2</td>
		    	  <td align="left"><input type="text" id="email2" name="email2" size="40" maxlength="100" value=""/></td>
		    	</tr>
			  </tbody>
			</table>
			</div>
		</div>

		<div id="boutons">
			<input type="button" class="button" id="btnValider" value="Valider">
			<input type="reset" class="button" id="btnEffacer" value="Effacer">
		</div>

	</form>

  </body>
</html>
<?php
ob_end_flush();
?>