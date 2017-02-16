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

if (isset($_SESSION['listeClubs'])) {
	$listeClubs = $_SESSION['listeClubs'];
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

			/*$('#tableATrier').dataTable({
			  	"bPaginate": false,
				"bLengthChange": false,
				"bFilter": false,
				"bSort": true,
				"bInfo": false,
				"bAutoWidth": false,
				"oLanguage": {
					"sSearch": "Filtrer ",
					"sZeroRecords": "Aucun enregistrement disponible."
				},
				"aaSorting": [ [1,'asc'] ],
				"aoColumns": [{ "bSortable": false }, null, null, null, { "bSortable": false }],
				"bJQueryUI": false
			});*/

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

		    $(".delete").click(function(e) {
		        e.preventDefault();
		        theHREF = "SupprimerClub.php?id="+$(this).attr("id").split("_")[1];
		        $("#dialog-confirm").find("p").html("Etes-vous sûr de vouloir supprimer le club : "+$(this).attr("id").split("_")[2]+" ?");
		        $("#dialog-confirm").dialog("open");
		    });

		    $(".fiche").click(function(e) {
		        e.preventDefault();
		        theHREF = "AfficherClub.php?id="+$(this).attr("id").split("_")[1];
				//popup(500, 400, $(this).attr("id").split("_")[2]+" - "+$(this).attr("id").split("_")[3], theHREF);
		        document.location = theHREF;
		    });

		    $(".modif").click(function(e) {
		        e.preventDefault();
		        theHREF = "ModifierClub.php?id="+$(this).attr("id").split("_")[1];
		        document.location = theHREF;
		    });

		    $("#ajouterClub").button().click(function(e) {
				  e.preventDefault();
				  //theHREF = "equipe.creer.do";
				  document.location = "CreerClub.php";
			  });
		});

		function popup(dialogWidth, dialogHeight, dialogTitle, url) {
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
	  $param="Liste des clubs";
	  include("menu.php");
	?>
	</div>

	<div style="text-align: center; ">
		<div class="CSSTableGenerator">
		<table id="tableATrier">
		<thead>
		<tr height="35px">
			<th>#</th>
			<th><b>Nom</b></th>
			<th><b>N° affiliation</b></th>
			<th><b>Ligue/District</b></th>
			<th><b>Action</b></th>
		</tr>
		</thead>
		<?php if (empty($listeClubs)) {?>
		<tr><td colspan="7">Aucun enregistrement disponible.</td></tr>
		<?php } else {
			?><tbody><?php
			foreach($listeClubs as $club) {
			?>
			<tr>
			<td>
				&nbsp;
			</td>
			<td>
				<?php echo $club->getNom();?>
			</td>
			<td>
				<?php echo $club->getNumAffiliation();?>
			</td>
			<td>
				<?php echo $club->getLigue()."/".$club->getDistrict();?>
			</td>
			<td>
				<img class="fiche" id="fiche_<?php echo $club->getId();?>" src="images/zoom16.gif" style="border-width: 0px;" title="Afficher le club"/>
				<img class="modif" id="modif_<?php echo $club->getId();?>" src="images/modif16.gif" style="border-width: 0px; width: 16px; height: 16px;" title="Modifier le club"/>
				<img class="delete" id="delete_<?php echo $club->getId();?>_<?php echo $club->getNom();?>" src="images/trash16.gif" style="border-width: 0px;" title="Supprimer le club"/>
			</td>
			</tr>
			<?php }?>
			</tbody>
		<?php }?>
		</table>
		</div>
		<br/>
		<br/>
		<input type="button" class="button" id="ajouterClub" value="Ajouter un club">

	    <div id="dialog-modale" style="display:none;"></div>
		<div id="dialog-confirm" title="Confirmation de la suppression" style="display:none;">
		    <p>
		        <span class="ui-icon ui-icon-alert" style="float:left; margin:0 7px 20px 0;"></span>
		    </p>
		</div>
	</div>
  </body>
</html>
<?php
ob_end_flush();
?>