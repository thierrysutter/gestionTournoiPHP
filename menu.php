<!-- <div id="header">
  <div id="login-contact">
    <a href="#">Login</a>
    <a href="#">A propos</a>
    <a href="#">Contact</a>
  </div>
</div>
-->
<div id="menu">
  <div id="menucontainer">
	  <div id="menunav">
	  <ul>
		  <li><a href="accueil.php" title="Accueil" class="<?php if ($menu == 'ACCUEIL') echo 'current'; else echo ''; ?>" ><span>Accueil</span></a></li>
		  <li><a href="AfficherListeClubs.php" title="Clubs" class="<?php if ($menu == 'CLUBS') echo 'current'; else echo ''; ?>" ><span>Clubs</span></a></li>
		  <li><a href="AfficherListeTournois.php" title="Tournoi" class="<?php if ($menu == 'TOURNOI') echo 'current'; else echo ''; ?>" ><span>Tournoi</span></a></li>
	  </ul>
	  <div id="menu-page"><?php echo $param ?></div>
	  <div id="menu-user">
	  <!--
	  <c:choose>
		<c:when test="${global_user.admin}">
		  <a href="choixFournisseur.do" style="color: #fff;">Fournisseur ${global_user.fournisseur.nom}</a>
		</c:when>
		<c:otherwise>
		  Fournisseur ${global_user.fournisseur.nom}
		</c:otherwise>
	  </c:choose>-->
	  Administrateur test
	  <!--
	  <a href="afficherChangementMotDePasse.do"><img src=images/picto_psw.gif style="border-width: 0px" title="Changer de mot de passe" /></a>
	  &nbsp;
	  <a href="afficherAide.do"><img src=images/picto_aide.gif style="border-width: 0px" title="Aide" /></a>
	  &nbsp;
	  <img src=images/picto_msg.gif style="border-width: 0px; cursor: pointer;" title="Historique des messages" onclick="afficherNotification('1');" />
	  &nbsp;-->
	  &nbsp;&nbsp;<a href="login.do?close=1"><img src=images/picto_stop.gif style="border-width: 0px; cursor: pointer;" title="Déconnexion" /></a>
	  &nbsp;
	  </div>
	</div>
	<!--
	<div id="menu-logo">
	  <img src="images/logo_pdm.png" />
	</div>-->
  </div>
</div>
<div style="padding-top: 50px;">&nbsp;</div>