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
	<script type="text/javascript" src="js/jquery/jquery.ui.datepicker-fr.js"></script>

	<script type="text/javascript">
		$(document).ready(function(){
			$( ".datepicker" ).datepicker( {
				showOn: "button",
				buttonImage: "images/date16.gif",
				buttonImageOnly: true
			});

			$(".ui-datepicker-trigger").each(function() {
	  			$(this).attr("alt","Calendrier");
	  			$(this).attr("title","");
	  		});

	  		$("img.ui-datepicker-trigger").click(
	  				function(){
	  					$(this).parent().find(".datepicker").blur();
	  					}
	  		);

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
			/* $("#nbGroupes").attr('disabled', false);
			$("#nbEquipesQualifiees").attr('disabled', false);
			$("#baremeVictoire").attr('disabled', false);
			$("#baremeNul").attr('disabled', false);
			$("#baremeDefaite").attr('disabled', false); */

			// vérification des champs du formulaire
			var valid = true;
			var form = document.form1;
			if(form.libelle == null || form.libelle.value == "") {
				alert("Le nom du tournoi est obligatoire");
				form.libelle.focus();
				valid = false;
				//return false;
			} else if(form.dateTournoi == null || form.dateTournoi.value == "") {
				alert("La date du tournoi est obligatoire");
				form.dateTournoi.focus();
				valid = false;
				//return false;
			} else if(form.categorie == null || form.categorie.value == "") {
				alert("La catégorie du tournoi est obligatoire");
				form.categorie.focus();
				valid = false;
				//return false;
			} else if(form.nbEquipes == null || form.nbEquipes.value == "") {
				alert("Le nombre d'équipes participantes est obligatoire");
				form.nbEquipes.focus();
				valid = false;
				//return false;
			} else if (form.nbEquipes.value < 2) {
				alert("Il faut au moins 2 équipes.");
				form.nbEquipes.focus();
				valid = false;
				//return false;
			} else if(form.nbTerrains == null || form.nbTerrains.value == "") {
				alert("Le nombre de terrains est obligatoire");
				form.nbTerrains.focus();
				valid = false;
				//return false;
			} else if (form.nbTerrains.value < 1) {
				alert("Il faut au moins 1 terrain.");
				form.nbEquipes.focus();
				valid = false;
				//return false;
			} else if(form.dureeRencontre == null || form.dureeRencontre.value == "") {
				alert("La durée des matchs est obligatoire");
				form.dureeRencontre.focus();
				valid = false;
				//return false;
			} else if(form.dureeRencontre.value <= 0) {
				alert("La durée des matchs doit être positive");
				form.dureeRencontre.focus();
				valid = false;
				//return false;
			} else if(form.typeTournoi.value != 1 && (form.baremeVictoire == null || form.baremeVictoire.value == "")) {
				alert("Le nombre de point pour une victoire est obligatoire");
				form.baremeVictoire.focus();
				valid = false;
				//return false;
			} else if(form.typeTournoi.value != 1 && (form.baremeNul == null || form.baremeNul.value == "")) {
				alert("Le nombre de point pour un nul est obligatoire");
				form.baremeNul.focus();
				valid = false;
				//return false;
			} else if(form.typeTournoi.value != 1 && (form.baremeDefaite == null || form.baremeDefaite.value == "")) {
				alert("Le nombre de point pour une défaite est obligatoire");
				form.baremeDefaite.focus();
				valid = false;
				//return false;
			} else if(form.typeTournoi.value != 1 && (form.baremeVictoire.value <= form.baremeNul.value || form.baremeNul.value <= form.baremeDefaite.value || form.baremeNul.value < 0)) {
				alert("Le barême des points n'est pas cohérent (victoire > nul > defaite >= 0)");
				form.baremeVictoire.focus();
				valid = false;
				//return false;
			} else if(form.typeTournoi.value != 1 && (form.nbGroupes == null || form.nbGroupes.value == "")) {
				alert("Le nombre de groupes est obligatoire");
				form.nbGroupes.focus();
				valid = false;
				//return false;
			} else if (form.typeTournoi.value == 3 && form.nbGroupes.value < 1) {
				alert("Il faut au moins 1 groupe.");
				form.nbGroupes.focus();
				valid = false;
				//return false;
			} else if(form.typeTournoi.value == 3 && (form.nbEquipesQualifieesGroupe == null || form.nbEquipesQualifieesGroupe.value == "")) {
				alert("Le nombre d'équipes qualifiées pour la phase finale est obligatoire");
				form.nbEquipesQualifiees.focus();
				valid = false;
				//return false;
			}

			if (valid) {
				form.submit();
			} else {
				/* $("#nbGroupes").attr('disabled', true);
				$("#nbEquipesQualifiees").attr('disabled', true);
				$("#baremeVictoire").attr('disabled', true);
				$("#baremeNul").attr('disabled', true);
				$("#baremeDefaite").attr('disabled', true); */
				return false;
			}
		}
	</script>

  </head>

  <body>
	<div>
	<?php
	  $menu="TOURNOI";
	  $param="Création du tournoi";
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

		<input type="hidden" name="mode" value="creation"/>

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
				  <td align="left"><input type="text" id="libelle" name="libelle" size="40" maxlength="50" value=""/></td>
				</tr>
				<tr>
				  <td align="right">Date</td>
				  <td align="left"><input type="text" class="datepicker" id="dateTournoi" name="dateTournoi" size="10"/></td>
				</tr>
				<tr>
				  <td align="right" >Catégorie</td>
				  <td align="left">
				  	<select id="categorie" name="categorie">
				  		<?php if(isset($categories)) { foreach($categories as $categorie) {?>
				  		<option value="<?php echo $categorie->getId(); ?>"><?php echo $categorie->getLibelle(); ?></option>
				  		<?php } } ?>
					</select></td>
				</tr>
				<tr>
				  <td align="right" >Type</td>
				  <td align="left"><select id="typeTournoi" name="typeTournoi">
					  	<option value="1">Elimination directe</option>
					  	<option value="2">Championnat</option>
					  	<option value="3">Groupe / Elimination directe</option>
					  </select></td>
				</tr>
				<tr>
			      <td align="right" >Nb equipes</td>
			      <td align="left">
			      	<input type="text" id="nbEquipes" name="nbEquipes" size="1" min="1"/>
			      </td>
			    </tr>
			    <tr>
			      <td align="right" >Nb terrains</td>
			      <td align="left"><input type="text" id="nbTerrains" name="nbTerrains" size="1" min="1"/></td>
			    </tr>
			    <tr>
				  <td align="right" >Durée des rencontres</td>
				  <td align="left"><input type="text" id="dureeRencontre" name="dureeRencontre" size="1" min="0"/></td>
				</tr>
				<tr>
				  <td align="right" >Barême de points</td>
				  <td align="left">Victoire: <input type="text" id="baremeVictoire" name="baremeVictoire" size="1" min="0"/><br/>
					  Nul: <input type="text" id="baremeNul" name="baremeNul" size="1" min="0"/><br/>
					  Défaite: <input type="text" id="baremeDefaite" name="baremeDefaite" size="1" min="0"/></td>
				</tr>
				<tr>
				  <td align="right" >Nb groupes</td>
				  <td align="left"><input type="text" id="nbGroupes" name="nbGroupes" size="1" min="1"/></td>
				</tr>
				<tr>
		    	  <td align="right">Nombre d'équipes qualifiées<br/>par groupe pour la phase finale</td>
		    	  <td align="left">
		    	  <input type="text" id="nbEquipesQualifieesGroupe" name="nbEquipesQualifieesGroupe" size="1" min="0"/></td>
				</tr>
				<tr>
				  <td align="right" >Consolante</td>
		    	  <td align="left"><input type="radio" id="consolante" name="consolante" value="1" />Oui&nbsp;
					  <input type="radio" id="consolante" name="consolante" value="0" checked="checked"/>Non</td>
				</tr>
				<tr>
				  <td align="right" >Description</td>
		    	  <td align="left"><textarea id="description" name="description" rows="10" cols="50"></textarea></td>
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