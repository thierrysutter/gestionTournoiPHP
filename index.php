<!DOCTYPE html>
<html lang="fr">
<head>
	<link rel="stylesheet" type="text/css" href="css/gestionTournoi.css" />
	<link rel="stylesheet" type="text/css" href="css/jquery-ui.css" />

	<script type="text/javascript" src="js/jquery/jquery-1.9.1.js"></script>
	<script type="text/javascript" src="js/jquery/jquery-ui.js"></script>

	<script type="text/javascript">
		$(document).ready(function(){
			$("#btnLogin").button().click(function(e) {
				  e.preventDefault();
				  return valideForm();
			  });
		});

		function valideForm() {
		  if (document.form1.login.value == "") {
		    alert("Le login utilisateur est obligatoire");
		    document.form1.login.focus();
		    return false;
		  }

		  if (document.form1.password.value == "") {
		    alert("Le mot de passe est obligatoire");
		    document.form1.password.focus();
		    return false;
		  }

		  form1.submit();
		  return true;
		}
	</script>
  </head>
  <body>
	<div style="text-align: center;">
		<img alt="Bienvenue" src="images/blason.png" >

		<!-- Formulaire d'identification à l'application -->
		<form action="ActionLogin.php" method="post" name="form1" style="height: 100%">
		 <input type="hidden" name="do" value="login">
		 <?php
		 if (isset($_SESSION['messageErreur'])) {
		   $messageErreur = $_SESSION['messageErreur'];
		   echo "<br /><br />";
		   echo '<div style="color: red; font-weight: bold;"><img src="images/alert16.gif" style="border: 0px" alt="alerte"/>'.$messageErreur.'</div>';
		   echo "<br /><br />";
		   unset($_SESSION['messageErreur']);
		 }
		 ?>

		 <table class="tftable" style="width: 300px;">
		  <tbody>
		   <tr>
		    <td align="right" height="32">Utilisateur </td>
		    <td align="left"><input type="text" id="login" name="login" maxlength="25" value="" onchange="controlerCGU();" />
		   </tr>
		   <tr>
		    <td align="right" height="32">Mot de passe </td>
		    <td align="left">
		      <input type="password" id="password" name="password" maxlength="25">
		      &nbsp;
		      <img src="images/info32.gif" title="Si vous ne connaissez pas ou plus vos identifiants contacter l'administrateur du site" style="border: 0px" width="20" height="20" alt="info" />
		    </td>
		   </tr>
		  </tbody>
		 </table>
		 <br/>
		 <input type="button" class="button" id="btnLogin" value="Valider">
		 <br />
		 <br />
		 Consulter les <a href="#">Conditions Générales d'Utilisation</a> de ce site.
		 <br />
		 <div id="divCGU" style="display: none;">
			<input name="CGUapprouve" id="CGUapprouve" type="checkbox" value="1" /> Je confirme avoir pris connaissance des Conditions Générales d'Utilisation de ce site et je les approuve.
		 </div>
		</form>
	</div>
   </body>

<?php /*
<body>

	<section id="content">
	<table class="tableCadrePage" align="center">
		<tr class="trCadrePage" align="center">
			<td class="tdCadrePage">
			<?php
				if (isset($_SESSION['messageKO'])) {
					$messageKO = $_SESSION['messageKO'];
					echo '<div style="color: red; font-weight: bold;"><img src="images/alert16.gif" style="padding: 4px; border: 0px" alt="alerte"/>'.$messageKO.'</div>';
					unset($_SESSION['messageKO']);
				}
				?>
				<br />
		<!-- début -->
			<form action="Login.php" method="post" name="form1" onSubmit="return valideForm();" style="width:300px">
				<input type="hidden" name="do" value="login">
				<table class="tftable" style="width: 300px;">
					<tr>
						<th colspan="2"><h2>Identification</h2></th>
					</tr>
					<tr>
						<td align="right" height=32 ><label for="login">Utilisateur : </label></td>
						<td align="left"><input type="text" id="login" name="login" maxlength="25" value=""></td>
					</tr>
					<tr>
						<td align="right" height=32><label for="password">Mot de passe : </label></td>
						<td align="left"><input type="password" id="password" name="password" maxlength="25"></td>
					</tr>
				</table>
				<br/><br/>
				<input class="bouton" type="submit" value="Valider">
			</form>
		<!-- fin -->
		</td>
		</tr>
	</table>
	</section>
	<?php
	//include('footer.php');
	?>
</body>
 */?>
</html>