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

if (isset($_SESSION['tournoi'])) {
	$tournoi = $_SESSION['tournoi'];
}
if (isset($_SESSION['categories'])) {
	$categories = $_SESSION['categories'];
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

			$("#btnAnnuler").button().click(function(e) {
				e.preventDefault();
				document.location = "AfficherListeTournois.php";
				return false;
			});
		});

		function valideForm() {
		  if (document.form1.nom.value == "") {
		    alert("Le nom du tournoi est obligatoire");
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
	  $menu="TOURNOI";
	  $param="Modification du tournoi";
	  include("menu.php");
	?>
	</div>


	<form name="form1" method="POST" action="EnregistrerTournoi.php">
		<?php
		if (isset($_SESSION['messageErreur'])) {
			$messageErreur = $_SESSION['messageErreur'];
		   	echo "<br /><br />";
		   	echo '<div style="color: red; font-weight: bold;"><img src="images/alert16.gif" style="border: 0px" alt="alerte"/>'.$messageErreur.'</div>';
		   	echo "<br /><br />";
		   	unset($_SESSION['messageErreur']);
		}
		?>
		<input type="hidden" name="mode" value="modif"/>
		<input type="hidden" name="id" value="<?php echo $tournoi->getId();?>"/>
		<div id="container">
			<table class="tftable">
			  <thead>
			  	<tr>
			  	  <th colspan="2">Informations générales</th>
			  	</tr>
			  </thead>
			  <tbody>
				<tr>
				  <td align="right" >Nom du tournoi</td>
				  <td align="left"><input type="text" id="libelle" name="libelle" size="40" maxlength="50" value="<?php echo $tournoi->getLibelle()!="" ? $tournoi->getLibelle() : "";?>"/></td>
				</tr>
				<tr>
				  <td align="right">Date</td>
				  <td align="left">
				  <?php list($annee,$mois,$jour) = explode("-",substr($tournoi->getDateTournoi(),0,10));
						$dateTournoi = $jour."/".$mois."/".$annee;
				  ?>
				  <input type="text" class="datepicker" id="dateTournoi" name="dateTournoi" size="10" value="<?php echo $dateTournoi!="" ? $dateTournoi : "";?>"/></td>
				</tr>
				<tr>
				  <td align="right" >Catégorie</td>
				  <td align="left">
				  	<select id="categorie" name="categorie">
				  		<?php if(isset($categories)) { foreach($categories as $categorie) {?>
				  		<option value="<?php echo $categorie->getId(); ?>" <?php if($tournoi->getCategorie()==$categorie->getId()) {echo "selected";} else {echo "";} ?> ><?php echo $categorie->getLibelle(); ?></option>
				  		<?php } } ?>
					</select></td>
				</tr>
				<tr>
				  <td align="right" >Type</td>
				  <td align="left"><select id="typeTournoi" name="typeTournoi">
					  	<option value="1" <?php if($tournoi->getTypeTournoi()==1) {echo "selected";} else {echo "";} ?>>Elimination directe</option>
					  	<option value="2" <?php if($tournoi->getTypeTournoi()==2) {echo "selected";} else {echo "";} ?>>Championnat</option>
					  	<option value="3" <?php if($tournoi->getTypeTournoi()==3) {echo "selected";} else {echo "";} ?>>Groupe / Elimination directe</option>
					  </select></td>
				</tr>
				<tr>
			      <td align="right" >Nb equipes</td>
			      <td align="left">
			      	<input type="text" id="nbEquipes" name="nbEquipes" size="1" min="1" value="<?php echo $tournoi->getNbEquipes()>0 ? $tournoi->getNbEquipes() : "";?>"/>
			      </td>
			    </tr>
			    <tr>
			      <td align="right" >Nb terrains</td>
			      <td align="left"><input type="text" id="nbTerrains" name="nbTerrains" size="1" min="1" value="<?php echo $tournoi->getNbTerrains()>0 ? $tournoi->getNbTerrains() : "";?>"/></td>
			    </tr>
			    <tr>
				  <td align="right" >Durée des rencontres</td>
				  <td align="left"><input type="text" id="dureeRencontre" name="dureeRencontre" size="1" min="0" value="<?php echo $tournoi->getDureeRencontre()>0 ? $tournoi->getDureeRencontre() : "";?>"/></td>
				</tr>
				<tr>
				  <td align="right" >Barême de points</td>
				  <td align="left">Victoire: <input type="text" id="baremeVictoire" name="baremeVictoire" size="1" min="0" value="<?php echo $tournoi->getBaremeVictoire();?>"/><br/>
					  Nul: <input type="text" id="baremeNul" name="baremeNul" size="1" min="0" value="<?php echo $tournoi->getBaremeNul();?>"/><br/>
					  Défaite: <input type="text" id="baremeDefaite" name="baremeDefaite" size="1" min="0" value="<?php echo $tournoi->getBaremeDefaite();?>"/></td>
				</tr>
				<tr>
				  <td align="right" >Nb groupes</td>
				  <td align="left"><input type="text" id="nbGroupes" name="nbGroupes" size="1" min="1" value="<?php echo $tournoi->getNbGroupes()>0 ? $tournoi->getNbGroupes() : "";?>"/></td>
				</tr>
				<tr>
		    	  <td align="right">Nombre d'équipes qualifiées<br/>par groupe pour la phase finale</td>
		    	  <td align="left">
		    	  <input type="text" id="nbEquipesQualifieesGroupe" name="nbEquipesQualifieesGroupe" size="1" min="0" value="<?php echo $tournoi->getNbEquipesQualifiees()>0 ? $tournoi->getNbEquipesQualifiees() : "";?>"/></td>
				</tr>
				<tr>
				  <td align="right" >Consolante</td>
		    	  <td align="left"><input type="radio" id="consolante" name="consolante" value="1" <?php if($tournoi->getConsolante()==1) {echo "checked='checked'";} else {echo "";} ?>/>Oui&nbsp;
					  <input type="radio" id="consolante" name="consolante" value="0" checked="checked" <?php if($tournoi->getConsolante()==0) {echo "checked='checked'";} else {echo "";} ?>/>Non</td>
				</tr>
				<tr>
				  <td align="right" >Description</td>
		    	  <td align="left"><textarea id="description" name="description" rows="10" cols="50"><?php echo $tournoi->getDescription()!="" ? $tournoi->getDescription() : "";?></textarea></td>
				</tr>
			  </tbody>
			</table>
		</div>

		<div id="boutons">
			<input type="button" class="button" id="btnValider" value="Valider">
			<input type="reset" class="button" id="btnEffacer" value="Effacer">
			<input type="button" class="button" id="btnAnnuler" value="Annuler">
		</div>

	</form>

  </body>
</html>
<?php
ob_end_flush();
?>