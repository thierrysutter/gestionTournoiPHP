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

if (isset($_SESSION['equipes'])) {
	$equipes = $_SESSION['equipes'];
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
			var theHREF;

			$( "#dialog-confirm" ).dialog({
		        resizable: false,
		        height:160,
		        width:500,
		        autoOpen: false,
		        modal: true,
		        buttons: {
		            "Oui": function() {
		                $(this).dialog("close");
		                window.location.href = theHREF;
		            },
		            "Non": function() {
		                $( this ).dialog( "close" );
		            }
		         }
		    });

			$("#btnRetour").button().click(function(e) {
				e.preventDefault();
				document.location = "AfficherListeTournois.php";
			});

			$("#enteteCategorie").click(function(e) {
				e.preventDefault();
				if ($("#imgCategorie").attr("src").indexOf("moins")>0) {
					$("#imgCategorie").attr({src:"images/tri_plus.gif"});
				} else if ($("#imgCategorie").attr("src").indexOf("plus")>0) {
					$("#imgCategorie").attr({src:"images/tri_moins.gif"});
				} else {
					$("#imgCategorie").attr({src:"images/tri_point.gif"});
				}
				$("#bodyCategorie").toggle();
			});

			$("#enteteEquipe").click(function(e) {
				e.preventDefault();
				if ($("#imgEquipe").attr("src").indexOf("moins")>0) {
					$("#imgEquipe").attr({src:"images/tri_plus.gif"});
				} else if ($("#imgEquipe").attr("src").indexOf("plus")>0) {
					$("#imgEquipe").attr({src:"images/tri_moins.gif"});
				} else {
					$("#imgEquipe").attr({src:"images/tri_point.gif"});
				}
				$("#bodyEquipe").toggle();
			});
/*
			$(".ajoutEquipe").button().click(function(e) {
				e.preventDefault();
				theHREF = "CreerEquipe.php?idTournoi="+$("#idTournoi").val();
				popup(400, 285, "Ajout equipe", theHREF, "equipe");
			});

			$(".deleteEquipe").button().click(function(e) {
				e.preventDefault();
				theHREF = "SupprimerTerrain.php?idTournoi="+$("#idTournoi").val()+"&libelle="+$(this).attr("id").split("_")[1];
				$("#dialog-confirm").find("p").html("Etes-vous sûr de vouloir supprimer ce terrain : "+$(this).attr("id").split("_")[1]+" ?");
		        $("#dialog-confirm").dialog("open");
			});
*/
		});

		function popup(dialogWidth, dialogHeight, dialogTitle, url, source) {
			$frame = $('#dialog-modale');
			$frame.dialog({
		        modal: true,
		        width: dialogWidth,
		        height: dialogHeight,
		        resizable: true,
		        position: "center",
		        buttons: {
		        	/*"OK": function(){
		        		$frame.dialog("close");
		        	},*/
		        	"Fermer": function(){
		        		$frame.dialog("close");
		        	}
		        },
		        title: dialogTitle,
		        /*show: {//l'affichage se fait avec l'effet blind
		        	effect: "blind",
		        	duration: 500
		        },
		        hide: {//la fermeture se fait avec l'effet explode
		        	effect: "explode",
		        	duration: 500
		        },*/
		        close: function(){
		        	// si on veut effectuer des opérations dans la page appelante à la fermeture de la popup modale c'est ici
		        	//alert("qdsdqsdqsfqsf");
		        	// appel de la fonction qui sera exécuté sur la page appelante à la fermeture de la popup
		        	// fonctionRetour();
		        	// ou ecrire le script directement ici
		        	if (source == "contact") {

		        	} else if (source == "terrain") {

		        	}
		        }
		    });
			$frame.load(url);
			$frame.css("width", "100%");
			$frame.dialog("open");
		}
	</script>

  </head>

  <body>
	<div>
	<?php
	  $menu="TOURNOI";
	  $param="Fiche du tournoi";
	  include("menu.php");
	?>
	</div>
	<input type="hidden" value="<?php echo $tournoi->getId();?>" id="idTournoi"/>
	<?php /*?>
	<div id="entete" style="margin: auto;">
	    <table>
	    <tr>
	    <td><img src="images/blason.png" style="width: 100px; height: 125px; border: 1px; border-style: solid; border-color: black; float: left;" /></td>
	    <td style="vertical-align: top; text-align: left;">
	    <span style="font-size: 30px; font-weight: bold; "><?php echo $tournoi->getNom()!="" ? $tournoi->getNom() : "";?></span><br>
	    <span style="text-align: left;font-size: 15px; font-weight: bold; "><?php echo $tournoi->getNumAffiliation()!="" ? "N° Affiliation: ".$tournoi->getNumAffiliation() : "";?></span><br>
	    <span style="font-size: 10px; font-weight: bold; ">
	    <?php echo $tournoi->getPays()!="" ? "Fédération: ".$tournoi->getPays() : "";?><br>
	    <?php echo $tournoi->getLigue()!="" ? "Ligue: ".$tournoi->getLigue() : "";?><br>
	    <?php echo $tournoi->getDistrict()!="" ? "District: ".$tournoi->getDistrict() : "";?><br>
	    <?php echo $tournoi->getSiteWeb()!="" ? $tournoi->getSiteWeb() : "";?>
	    </span>
	    </td>
	    </tr>
	    </table>
	</div>
	<?php */?>

	<div id="container">

	  <div id="colonneG">
		<table class="tftable" style="width: 98%;">
		  <thead>
		  	<tr>
		  	  <th colspan="2">Informations générales</th>
		  	</tr>
		  </thead>
		  <tbody>
			<tr>
	    	  <td align="right">Nom</td>
	    	  <td align="left" style="width: 80%;"><?php echo $tournoi->getLibelle()!="" ? $tournoi->getLibelle() : "";?></td>
			</tr>
			<tr>
			  <td align="right" >Date</td>
	    	  <td align="left"><?php list($annee,$mois,$jour) = explode("-",substr($tournoi->getDateTournoi(),0,10));
						$dateTournoi = $jour."/".$mois."/".$annee;
						echo $dateTournoi;
				  ?>
			  </td>
			</tr>
			<tr>
			  <td align="right" >Catégorie</td>
	    	  <td align="left"><?php echo $tournoi->getCategorie()>0 ? $tournoi->getLibelleCategorie() : "";?></td>
			</tr>
			<tr>
			  <td align="right" >Type</td>
			  <td align="left" style="width: 80%;"><?php echo $tournoi->getTypeTournoi()!="" ? $tournoi->getLibelleTypeTournoi() : "";?></td>
			</tr>
			<tr>
			  <td align="right" >Nb équipes</td>
			  <td align="left"><?php echo $tournoi->getNbEquipes()>0 ? $tournoi->getNbEquipes() : "";?></td>
			</tr>
			<tr>
			  <td align="right" >Nb terrains</td>
	    	  <td align="left"><?php echo $tournoi->getNbTerrains()>0 ? $tournoi->getNbTerrains() : "";?></td>
	    	</tr>
	    	<tr>
			  <td align="right" >Durée des rencontres</td>
	    	  <td align="left"><?php echo $tournoi->getDureeRencontre()>0 ? $tournoi->getDureeRencontre() : "";?></td>
	    	</tr>
	    	<tr>
	    	  <td align="right" >Barême de points</td>
	    	  <td align="left">Victoire: <?php echo $tournoi->getBaremeVictoire();?><br>
	    	  	Nul: <?php echo $tournoi->getBaremeNul();?><br>
	    	  	Défaite: <?php echo $tournoi->getBaremeDefaite();?><br>
	    	  </td>
	    	</tr>
	    	<tr>
	    	  <td align="right" >Nb groupes</td>
	    	  <td align="left"><?php echo $tournoi->getNbGroupes()>0 ? $tournoi->getNbGroupes() : "";?></td>
	    	</tr>

		    <tr>
			  <td align="right" >Nombre d'équipes qualifiées<br/>par groupe pour la phase finale</td>
			  <td align="left"><?php echo $tournoi->getNbEquipesQualifiees()>0 ? $tournoi->getNbEquipesQualifiees() : "";?></td>
			</tr>
			<tr>
			  <td align="right" >Consolante</td>
			  <td align="left"><?php echo $tournoi->getConsolante()!="" ? $tournoi->getConsolante() : "";?></td>
			</tr>
			<tr>
			  <td align="right" >Description</td>
			  <td align="left"><?php echo $tournoi->getDescription()!="" ? $tournoi->getDescription() : "";?></td>
			</tr>
		  </tbody>
		</table>
	  </div>

	  <div id="colonneG">
		<table class="tftable" style="width: 98%;margin-bottom: 10px;">
		  <thead>
		  	<tr>
		  	  <th colspan="2" id="enteteCategorie">
		  	  <img id="imgCategorie"  src="images/tri_plus.gif" style="height: 12px; width: 12px;cursor: pointer;float: left;"/>Categories
		  	  </th>
		  	</tr>
		  </thead>
		  <tbody id="bodyCategorie" style="display: none;">
		    <?php if (is_null($categories) || empty($categories)) {?>
			<tr>
			  <td colspan="2">Aucune catégorie</td>
			</tr>
			<?php } else {
			foreach($categories as $categorie) {
			?>
			<tr>
			  <td align="left" style="width: 95%;">
			    <?php echo $categorie->getLibelle()!="" ? $categorie->getLibelle() : ""; ?>
			  </td>
			  <td align="right">
			  <img class="ficheCategorie" id="ficheCategorie_<?php echo $categorie->getId();?>" src="images/zoom16.gif" style="background: white;border-width: 0px;"/>
			  <img class="deleteCategorie" id="deleteCategorie_<?php echo $categorie->getId();?>" src="images/trash16.gif" style="background: white;border-width: 0px;"/>
			  </td>
			</tr>
			<?php } } ?>
			<tr><td colspan="2"><a href="#" class="ajoutCategorie" id="ajoutCategorie" style="font-size:10px; cursor: pointer;float: right;">Ajouter une catégorie</a></td></tr>
		  </tbody>
		</table>

		<table class="tftable" style="width: 98%;margin-bottom: 10px;">
		  <thead>
		  	<tr>
		  	  <th colspan="2" id="enteteEquipe">
		  	  <img id="imgEquipe"  src="images/tri_plus.gif" style="height: 12px; width: 12px;cursor: pointer;float: left;"/>Equipes inscrites
		  	  </th>
		  	</tr>
		  </thead>
		  <tbody id="bodyEquipe" style="display: none;">
		    <?php if (is_null($equipes) || empty($equipes)) {?>
			<tr>
			  <td colspan="2">Aucune équipe</td>
			</tr>
			<?php } else {
			foreach($equipes as $equipe) {
			?>
			<tr>
			  <td align="left" style="width: 95%;">
			    <?php echo $equipe->getLibelle()!="" ? $equipe->getLibelle() : ""; ?>
			  </td>
			  <td align="right">
			  <img class="ficheEquipe" id="ficheEquipe_<?php echo $equipe->getId();?>" src="images/zoom16.gif" style="background: white;border-width: 0px;"/>
			  <img class="deleteEquipe" id="deleteEquipe_<?php echo $equipe->getId();?>" src="images/trash16.gif" style="background: white;border-width: 0px;"/>
			  </td>
			</tr>
			<?php } } ?>
			<tr><td colspan="2"><a href="#" class="ajoutEquipe" id="ajoutEquipe" style="font-size:10px; cursor: pointer;float: right;">Ajouter une équipe</a></td></tr>
		  </tbody>
		</table>
	  </div>
	</div>

	<div id="boutons">
		<input type="button" class="button" id="btnRetour" value="Retour">
	</div>

	<div id="dialog-modale" style="display:none;"></div>
	<div id="dialog-confirm" title="Confirmation de la suppression" style="display:none;">
	    <p>
	        <span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
	    </p>
	</div>
  </body>
</html>
<?php
ob_end_flush();
?>