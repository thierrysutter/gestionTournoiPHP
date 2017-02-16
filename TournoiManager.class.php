<?php
class TournoiManager {
	private $_db;

	public function __construct($db)
	{
		$this->setDb($db);
	}

	public function setDb(PDO $db)
	{
		$this->_db = $db;
	}

	public function trouverTournois($codeTournoi)
	{
		// Retourne la liste des tournois.
		// Le résultat sera un tableau d'instances de Tournoi.

		$tournois = array();

		$requete = "SELECT t.id, t.libelle, t.statut, st.LIBELLE as libelleStatut, ";
		$requete = $requete."pt.DATE_TOURNOI as dateTournoi, pt.TYPE_TOURNOI as typeTournoi, tt.LIBELLE as libelleTypeTournoi, pt.categorie, ";
		$requete = $requete."c.LIBELLE as libelleCategorie, pt.description, pt.lieu, pt.reglement, pt.plaquette, ";
		$requete = $requete."pt.NB_EQUIPES as nbEquipes, pt.NB_TERRAINS as nbTerrains, pt.DUREE_RENCONTRE as dureeRencontre, pt.BAREME_VICTOIRE as baremeVictoire, pt.BAREME_NUL as baremeNul, ";
		$requete = $requete."pt.BAREME_DEFAITE as baremeDefaite, pt.NB_GROUPES as nbGroupes, pt.NB_EQUIPES_FINALE as nbEquipesQualifiees, pt.consolante ";
		$requete = $requete."FROM tournoi t ";
		$requete = $requete."INNER JOIN statut_tournoi st ON (t.STATUT=st.ID) ";
		$requete = $requete."INNER JOIN parametres_tournoi pt ON (t.ID=pt.TOURNOI) ";
		$requete = $requete."INNER JOIN categorie c ON (pt.CATEGORIE=c.ID) ";
		$requete = $requete."INNER JOIN type_tournoi tt ON (pt.TYPE_TOURNOI=tt.ID) ";

		if($codeTournoi > 0) {
			$requete = $requete."WHERE t.id = '".$codeTournoi."' ";
		}

		$requete = $requete."ORDER BY t.id ";
		//echo $requete;
		$q = $this->_db->query($requete);
		//$q->execute();

		while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
		{
			$tournois[] = new Tournoi($donnees);
		}

		return $tournois;
	}

	public function ajouterTournoi($libelle)
	{
		// Préparation de la requête d'insertion.
		$q = $this->_db->query("INSERT INTO tournoi (LIBELLE, STATUT, DATE_CREATION, USER_MAJ, DERNIERE_MAJ) VALUES ('$libelle','0',curdate(),'test',now())");
	}

	public function supprimerTournoi($codeTournoi)
	{
		// Exécute une requête de type DELETE.
		$this->_db->exec("DELETE FROM tournoi WHERE id = '$codeTournoi'");
	}

	public function changerStatutTournoi($codeTournoi, $nouveauStatut)
	{
		// Prépare une requête de type UPDATE.
		$q = $this->_db->query("UPDATE tournoi SET statut = '$nouveauStatut', DERNIERE_MAJ = now() WHERE id = '$codeTournoi'");
	}
}
?>