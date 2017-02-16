<?php
class ClubManager {
	private $_db;

	public function __construct($db)
	{
		$this->setDb($db);
	}

	public function setDb(PDO $db)
	{
		$this->_db = $db;
	}

	public function trouverClubs($codeClub)
	{
		// Retourne la liste des clubs.
		// Le résultat sera un tableau d'instances de Club.

		$clubs = array();

		$requete = "SELECT c.id, c.nom, c.num_affiliation as numAffiliation, c.ligue, c.district, c.logo, c.site_web as siteWeb, ";
		$requete = $requete."c.adresse1, c.adresse2, c.adresse3, c.code_postal as codePostal, c.ville, c.pays, ";
		$requete = $requete."c.email1, c.email2, c.tel1, c.tel2, c.fax1, c.fax2, c.stade, ";
		$requete = $requete."c.couleur1, c.couleur2 ";
		$requete = $requete."FROM club c ";

		if($codeClub > 0) {
			$requete = $requete."WHERE c.id = '".$codeClub."' ";
		}

		$requete = $requete."ORDER BY c.nom asc ";

		$q = $this->_db->query($requete);

		while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
		{
			$clubs[] = new Club($donnees);
		}
		return $clubs;
	}

	public function ajouterClub($nom, $numAffiliation, $ligue, $district, $logo, $siteWeb, $adresse1, $adresse2, $adresse3, $codePostal, $ville, $pays, $email1, $email2, $tel1, $tel2, $fax1, $fax2, $stade, $couleur1, $couleur2)
	{
		// Préparation de la requête d'insertion.
		if ($siteWeb != "")
			$siteWeb="http://".$siteWeb;

		$requete = "INSERT INTO club (NOM, NUM_AFFILIATION, LIGUE, DISTRICT, LOGO, SITE_WEB, ADRESSE1, "
			."ADRESSE2, ADRESSE3, CODE_POSTAL, VILLE, PAYS, EMAIL1, EMAIL2, TEL1, TEL2, FAX1, FAX2, STADE, COULEUR1, "
			."COULEUR2, DATE_CREATION, USER_MAJ, DERNIERE_MAJ) "
			."VALUES (upper('$nom'),upper('$numAffiliation'), upper('$ligue'), upper('$district'), '$logo', "
			."upper('$siteWeb'), upper('$adresse1'), "
			."upper('$adresse2'),upper('$adresse3'), upper('$codePostal'), upper('$ville'), upper('$pays'), '$email1', '$email2', "
			."'$tel1','$tel2', '$fax1', '$fax2', upper('$stade'), upper('$couleur1'), upper('$couleur2'), "
			."curdate(), 'test', now())";

		$q = $this->_db->query($requete);
	}

	public function mettreAJourClub($idClub, $nom, $numAffiliation, $ligue, $district, $logo, $siteWeb, $adresse1, $adresse2, $adresse3, $codePostal, $ville, $pays, $email1, $email2, $tel1, $tel2, $fax1, $fax2, $stade, $couleur1, $couleur2)
	{
		// Préparation de la requête d'insertion.
		if ($siteWeb != "")
			$siteWeb="http://".$siteWeb;

		$requete = "UPDATE club "
			."SET NOM=upper('$nom'), NUM_AFFILIATION=upper('$numAffiliation'), LIGUE=upper('$ligue'), DISTRICT=upper('$district'), LOGO='$logo', SITE_WEB=upper('$siteWeb'), ADRESSE1=upper('$adresse1'), "
			."ADRESSE2=upper('$adresse2'), ADRESSE3=upper('$adresse3'), CODE_POSTAL=upper('$codePostal'), VILLE=upper('$ville'), PAYS=upper('$pays'), EMAIL1='$email1', EMAIL2='$email2', "
			."TEL1='$tel1', TEL2='$tel2', FAX1='$fax1', FAX2='$fax2', STADE=upper('$stade'), COULEUR1=upper('$couleur1'), COULEUR2=upper('$couleur2'), "
			."USER_MAJ='test', DERNIERE_MAJ=now() "
			."WHERE ID='$idClub' ";

		$q = $this->_db->query($requete);
	}

	public function supprimerClub($codeClub)
	{
		// Exécute une requête de type DELETE.
		$requete = "DELETE FROM club WHERE id = '$codeClub'";
		$this->_db->exec($requete);
	}

	/*public function changerStatutTournoi($codeTournoi, $nouveauStatut)
	{
		// Prépare une requête de type UPDATE.
		$q = $this->_db->query("UPDATE tournoi SET statut = '".$nouveauStatut."', DERNIERE_MAJ = now() WHERE id = '".$codeTournoi."'");
	}*/
}
?>