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

if (isset($_SESSION['club'])) {
	$club = $_SESSION['club'];
}

if (isset($_SESSION['terrains'])) {
	$terrains = $_SESSION['terrains'];
}

if (isset($_SESSION['contacts'])) {
	$contacts = $_SESSION['contacts'];
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
				document.location = "AfficherListeClubs.php";
			});

			$("#enteteContact").click(function(e) {
				e.preventDefault();
				if ($("#imgContact").attr("src").indexOf("moins")>0) {
					$("#imgContact").attr({src:"images/tri_plus.gif"});
				} else if ($("#imgContact").attr("src").indexOf("plus")>0) {
					$("#imgContact").attr({src:"images/tri_moins.gif"});
				} else {
					$("#imgContact").attr({src:"images/tri_point.gif"});
				}
				$("#bodyContact").toggle();
			});

			$("#enteteTerrain").click(function(e) {
				e.preventDefault();
				if ($("#imgTerrain").attr("src").indexOf("moins")>0) {
					$("#imgTerrain").attr({src:"images/tri_plus.gif"});
				} else if ($("#imgTerrain").attr("src").indexOf("plus")>0) {
					$("#imgTerrain").attr({src:"images/tri_moins.gif"});
				} else {
					$("#imgTerrain").attr({src:"images/tri_point.gif"});
				}
				$("#bodyTerrain").toggle();
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

			$(".ajoutContact").button().click(function(e) {
				e.preventDefault();
				theHREF = "CreerContact.php?idClub="+$("#idClub").val();
				popup(600, 540, "Ajout contact", theHREF, "contact");
			});

			$(".ajoutTerrain").button().click(function(e) {
				e.preventDefault();
				theHREF = "CreerTerrain.php?idClub="+$("#idClub").val();
				popup(400, 285, "Ajout terrain", theHREF, "terrain");
			});

			$(".ajoutEquipe").button().click(function(e) {
				e.preventDefault();
				theHREF = "CreerEquipe.php?idClub="+$("#idClub").val();
				popup(400, 285, "Ajout equipe", theHREF, "equipe");
			});

			$(".deleteContact").button().click(function(e) {
				e.preventDefault();
				theHREF = "SupprimerContact.php?idClub="+$("#idClub").val()+"&nom="+$(this).attr("id").split("_")[1];
				$("#dialog-confirm").find("p").html("Etes-vous sûr de vouloir supprimer ce contact : "+$(this).attr("id").split("_")[1]+" ?");
		        $("#dialog-confirm").dialog("open");
			});

			$(".deleteTerrain").button().click(function(e) {
				e.preventDefault();
				theHREF = "SupprimerTerrain.php?idClub="+$("#idClub").val()+"&libelle="+$(this).attr("id").split("_")[1];
				$("#dialog-confirm").find("p").html("Etes-vous sûr de vouloir supprimer ce terrain : "+$(this).attr("id").split("_")[1]+" ?");
		        $("#dialog-confirm").dialog("open");
			});

			$(".ficheContact").button().click(function(e) {
				e.preventDefault();
				theHREF = "AfficherContact.php?idClub="+$("#idClub").val()+"&nom="+$(this).attr("id").split("_")[1];
				popup(600, 540, "Visu contact", theHREF, "contact");
			});

			$(".ficheTerrain").button().click(function(e) {
				e.preventDefault();
				theHREF = "AfficherTerrain.php?idClub="+$("#idClub").val()+"&libelle="+$(this).attr("id").split("_")[1];
				popup(400, 285, "Visu terrain", theHREF, "terrain");
			});
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
	  $menu="CLUBS";
	  $param="Fiche du club";
	  include("menu.php");
	?>
	</div>
	<input type="hidden" value="<?php echo $club->getId();?>" id="idClub"/>

	<div id="entete" style="margin: auto;">
	    <table>
	    <tr>
	    <td><img src="images/blason.png" style="width: 100px; height: 125px; border: 1px; border-style: solid; border-color: black; float: left;" /></td>
	    <td style="vertical-align: top; text-align: left;">
	    <span style="font-size: 30px; font-weight: bold; "><?php echo $club->getNom()!="" ? $club->getNom() : "";?></span><br>
	    <span style="text-align: left;font-size: 15px; font-weight: bold; "><?php echo $club->getNumAffiliation()!="" ? "N° Affiliation: ".$club->getNumAffiliation() : "";?></span><br>
	    <span style="font-size: 10px; font-weight: bold; ">
	    <?php echo $club->getPays()!="" ? "Fédération: ".$club->getPays() : "";?><br>
	    <?php echo $club->getLigue()!="" ? "Ligue: ".$club->getLigue() : "";?><br>
	    <?php echo $club->getDistrict()!="" ? "District: ".$club->getDistrict() : "";?><br>
	    <?php echo $club->getSiteWeb()!="" ? $club->getSiteWeb() : "";?>
	    </span>
	    </td>
	    </tr>
	    </table>
	</div>

	<div id="container">

	  <div id="colonneG">
		<table class="tftable" style="width: 98%;">
		  <thead>
		  	<tr>
		  	  <th colspan="2">Coordonnées principales</th>
		  	</tr>
		  </thead>
		  <tbody>
			<tr>
	    	  <td align="right">Adresse</td>
	    	  <td align="left" style="width: 80%;">
	    	  <?php echo $club->getAdresse1()!="" ? $club->getAdresse1() : "";?><br/>
	    	  <?php echo $club->getAdresse2()!="" ? $club->getAdresse2() : "";?><br/>
	    	  <?php echo $club->getAdresse3()!="" ? $club->getAdresse3() : "";?></td>
			</tr>
			<tr>
			  <td align="right" >Code postal</td>
	    	  <td align="left"><?php echo $club->getCodePostal()!="" ? $club->getCodePostal() : "";?></td>
			</tr>
			<tr>
			  <td align="right" >Ville</td>
	    	  <td align="left"><?php echo $club->getVille()!="" ? $club->getVille() : "";?></td>
			</tr>


			<tr>
			  <td align="right" >Tel 1</td>
			  <td align="left" style="width: 80%;"><?php echo $club->getTel1()!="" ? $club->getTel1() : "";?></td>
			</tr>
			<tr>
			  <td align="right" >Tel 2</td>
			  <td align="left"><?php echo $club->getTel2()!="" ? $club->getTel2() : "";?></td>
			</tr>
			<tr>
			  <td align="right" >Fax 1</td>
	    	  <td align="left"><?php echo $club->getFax1()!="" ? $club->getFax1() : "";?></td>
	    	</tr>
	    	<tr>
			  <td align="right" >Fax 2</td>
	    	  <td align="left"><?php echo $club->getFax2()!="" ? $club->getFax2() : "";?></td>
	    	</tr>
	    	<tr>
	    	  <td align="right" >Email 1</td>
	    	  <td align="left"><?php echo $club->getEmail1()!="" ? $club->getEmail1() : "";?></td>
	    	</tr>
	    	<tr>
	    	  <td align="right" >Email 2</td>
	    	  <td align="left"><?php echo $club->getEmail2()!="" ? $club->getEmail2() : "";?></td>
	    	</tr>

		    <tr>
			  <td align="right" >Stade</td>
			  <td align="left"><?php echo $club->getStade()!="" ? $club->getStade() : "";?></td>
			</tr>
			<tr>
			  <td align="right" >Couleur 1</td>
			  <td align="left"><?php echo $club->getCouleur1()!="" ? $club->getCouleur1() : "";?></td>
			</tr>
			<tr>
			  <td align="right" >Couleur 2</td>
			  <td align="left"><?php echo $club->getCouleur2()!="" ? $club->getCouleur2() : "";?></td>
			</tr>
		  </tbody>
		</table>
	  </div>
	  <div id="colonneG">
		<table class="tftable" style="width: 98%;margin-bottom: 10px;">
		  <thead>
		  	<tr>
		  	  <th colspan="2" id="enteteContact">
		  	  <img id="imgContact"  src="images/tri_plus.gif" style="height: 12px; width: 12px;cursor: pointer;float: left;"/>Contacts
		  	  </th>
		  	</tr>
		  </thead>
		  <tbody id="bodyContact" style="display: none;">
		    <?php if (is_null($contacts) || empty($contacts)) {?>
			<tr>
			  <td colspan="2">Aucun contact</td>
			</tr>
			<?php } else {
			foreach($contacts as $contact) {
			?>
			<tr>
			  <td align="left" style="width: 95%;">
			    <?php echo $contact->getFonction()!="" ? $contact->getFonction() : ""; ?><br>
			    <?php echo $contact->getNom()!="" ? $contact->getNom() : "";?><?php echo $contact->getPrenom()!="" ? " - ".$contact->getPrenom() : "";?><br>
			    <?php echo $contact->getTel()!="" ? "Tel: ".$contact->getTel() : "";?><br>
			    <?php echo $contact->getEmail()!="" ? "Email: ".$contact->getEmail() : "";?>
			  </td>
			  <td align="right">
			  <img class="ficheContact" id="ficheContact_<?php echo $contact->getNom();?>" src="images/zoom16.gif" style="cursor: pointer;background: white;border-width: 0px;"/>
			  <img class="deleteContact" id="deleteContact_<?php echo $contact->getNom();?>" src="images/trash16.gif" style="cursor: pointer;background: white;border-width: 0px;"/>
			  </td>
			</tr>
			<?php } } ?>
			<tr><td colspan="2"><a href="#" class="ajoutContact" id="ajoutContact" style="font-size:10px; cursor: pointer;float: right;">Ajouter un contact</a></td></tr>
		  </tbody>
		</table>

		<table class="tftable" style="width: 98%;margin-bottom: 10px;"">
		  <thead>
		  	<tr>
		  	  <th colspan="2" id="enteteTerrain"><img id="imgTerrain" src="images/tri_plus.gif" style="height: 12px; width: 12px;cursor: pointer;float: left;"/>Terrains</th>
		  	</tr>
		  </thead>
		  <tbody id="bodyTerrain" style="display: none;">
			<?php if (is_null($terrains) || empty($terrains)) { ?>
			<tr>
			  <td colspan="2">Aucun terrain</td>
			</tr>
			<?php } else {
			foreach($terrains as $terrain) {
			?>
			<tr>
			  <td align="left" style="width: 95%;">
			  	<?php echo $terrain->getLibelle()!="" ? $terrain->getLibelle() : ""; ?><br>
			  	<?php echo $terrain->getType()!="" ? $terrain->getType() : "";?>
			  </td>
			  <td align="center">
			  <img class="ficheTerrain" id="ficheTerrain_<?php echo $terrain->getLibelle();?>" src="images/zoom16.gif" style="cursor: pointer;background: white;border-width: 0px;"/>
			  <img class="deleteTerrain" id="deleteTerrain_<?php echo $terrain->getLibelle();?>" src="images/trash16.gif" style="cursor: pointer;background: white;border-width: 0px;"/>
			  </td>
			</tr>
			<?php } }?>
			<tr><td colspan="2"><a href="#" class="ajoutTerrain" id="ajoutTerrain" style="font-size:10px; cursor: pointer;float: right;">Ajouter un terrain</a></td></tr>
		  </tbody>
		</table>

		<table class="tftable" style="width: 98%;margin-bottom: 10px;"">
		  <thead>
		  	<tr>
		  	  <th colspan="2" id="enteteEquipe"><img id="imgEquipe" src="images/tri_plus.gif" style="height: 12px; width: 12px;cursor: pointer;float: left;"/>Equipes</th>
		  	</tr>
		  </thead>
		  <tbody id="bodyEquipe" style="display: none;">
			<?php if (is_null($terrains) || empty($terrains)) { ?>
			<tr>
			  <td colspan="2">Aucune équipe</td>
			</tr>
			<?php } else {
			foreach($terrains as $terrain) {
			?>
			<tr>
			  <td align="left" style="width: 95%;">
			  	<?php echo $terrain->getLibelle()!="" ? $terrain->getLibelle() : ""; ?><br>
			  	<?php echo $terrain->getType()!="" ? $terrain->getType() : "";?>
			  </td>
			  <td align="center">
			  <img class="ficheEquipe" id="ficheEquipe_<?php echo $terrain->getLibelle();?>" src="images/zoom16.gif" style="cursor: pointer;background: white;border-width: 0px;"/>
			  <img class="deleteEquipe" id="deleteEquipe_<?php echo $terrain->getLibelle();?>" src="images/trash16.gif" style="cursor: pointer;background: white;border-width: 0px;"/>
			  </td>
			</tr>
			<?php } }?>
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