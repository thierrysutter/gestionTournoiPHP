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

if (isset($_SESSION['listeTournois'])) {
	$listeTournois = $_SESSION['listeTournois'];
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

		/* méthode tri pour les colonnes contenant des dates */
		jQuery.fn.dataTableExt.oSort['date-asc']  = function(a,b) {
		    var datea = a.split('/');
		    var dateb = b.split('/');

		    var x = (datea[2] + datea[1] + datea[0]) * 1;
		    var y = (dateb[2] + dateb[1] + dateb[0]) * 1;

		    return ((x < y) ? -1 : ((x > y) ?  1 : 0));
		};

		jQuery.fn.dataTableExt.oSort['date-desc'] = function(a,b) {
		    var datea = a.split('/');
		    var dateb = b.split('/');

		    var x = (datea[2] + datea[1] + datea[0]) * 1;
		    var y = (dateb[2] + dateb[1] + dateb[0]) * 1;

		    return ((x < y) ? 1 : ((x > y) ?  -1 : 0));
		};

		$(document).ready(function(){

			var theHREF;

			$('#tableATrier').dataTable({
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
				"aoColumns": [{ "bSortable": false }, null,{ "sType": 'date' }, null, null, null, { "bSortable": false }],
				"bJQueryUI": false
			});

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
		        theHREF = "SupprimerTournoi.php?id="+$(this).attr("id").split("_")[1];
		        $("#dialog-confirm").find("p").html("Etes-vous sûr de vouloir supprimer le tournoi : "+$(this).attr("id").split("_")[2]+" ?");
		        $("#dialog-confirm").dialog("open");
		    });

		    $(".fiche").click(function(e) {
		        e.preventDefault();
		        theHREF = "AfficherTournoi.php?id="+$(this).attr("id").split("_")[1];
				//popup(500, 400, $(this).attr("id").split("_")[2]+" - "+$(this).attr("id").split("_")[3], theHREF);
				document.location = theHREF;
		    });

		    $(".modif").click(function(e) {
		        e.preventDefault();
		        theHREF = "ModifierTournoi.php?id="+$(this).attr("id").split("_")[1]+"&statut="+$(this).attr("id").split("_")[2];
		        document.location = theHREF;
		    });

		    $("#ajouterTournoi").button().click(function(e) {
				  e.preventDefault();
				  //theHREF = "equipe.creer.do";
				  document.location = "CreerTournoi.php";
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
	  $menu="TOURNOI";
	  $param="Liste des tournois";
	  include("menu.php");
	?>
	</div>
	<div style="text-align: center; ">
		<div class="CSSTableGenerator">
		<table id="tableATrier">
		<thead>
		<tr height="35px">
			<th>#</th>
			<th><b>Libelle</b></th>
			<th><b>Date</b></th>
			<th><b>Catégorie</b></th>
			<th><b>Description</b></th>
			<th><b>Etat</b></th>
			<th><b>Action</b></th>
			<!-- <br><br><img src="images/tableaux/fleche_up_off.gif" /><img src="images/tableaux/fleche_down_off.gif" /> -->
		</tr>
		</thead>
		<?php if (empty($listeTournois)) {?>
		<tr><td colspan="7">Aucun enregistrement disponible.</td></tr>
		<?php } else {
			foreach($listeTournois as $tournoi) {
			?>
			<tr>
			<td>
				&nbsp;
			</td>
			<td>
				<?php echo $tournoi->getLibelle();?>
			</td>
			<td>
				<?php
						list($annee,$mois,$jour) = explode("-",substr($tournoi->getDateTournoi(),0,10));
						$dateTournoi = $jour."/".$mois."/".$annee;
						echo $dateTournoi;
						?>
			</td>
			<td>
				<?php echo $tournoi->getLibelleCategorie();?>
			</td>
			<td>
				<?php echo $tournoi->getDescription();?>
			</td>
			<td>
				<?php echo $tournoi->getLibelleStatut();?>
			</td>
			<td>
				<img class="fiche" id="fiche_<?php echo $tournoi->getId();?>_<?php echo $tournoi->getLibelle();?>_<?php echo $tournoi->getDateTournoi();?>" src="images/zoom16.gif" style="border-width: 0px;" title="Afficher le tournoi"/>
				<img class="modif" id="modif_<?php echo $tournoi->getId();?>_<?php echo $tournoi->getStatut();?>" src="images/modif16.gif" style="border-width: 0px; width: 16px; height: 16px;" title="Paramétrer le tournoi"/>
				<img class="delete" id="delete_<?php echo $tournoi->getId();?>_<?php echo $tournoi->getLibelle();?>" src="images/trash16.gif" style="border-width: 0px;" title="Supprimer un tournoi"/>
			</td>
		</tr>
			<?php }?>
		<?php }?>
		</table>
		</div>
		<br/>
		<br/>
		<input type="button" class="button" id="ajouterTournoi" value="Ajouter un tournoi">

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
