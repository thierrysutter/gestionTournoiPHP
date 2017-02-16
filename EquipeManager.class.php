<?php
class EquipeManager {
	private $_db;

	public function __construct($db)
	{
		$this->setDb($db);
	}

	public function setDb(PDO $db)
	{
		$this->_db = $db;
	}

	public function trouverEquipes()
	{
		// Retourne la liste des équipes.
		// Le résultat sera un tableau d'instances de Equipe.

		$equipes = array();

		$q = $this->_db->query("SELECT id, libelle FROM equipe ORDER BY libelle desc");
		//$q->execute();

		while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
		{
			$equipes[] = new Equipe($donnees);
		}

		return $equipes;
	}

	public function trouverEquipesDispo($codeTournoi)
	{
		// Retourne la liste des équipes non encore inscrites au tournoi.
		// Le résultat sera un tableau d'instances de Equipe.

		$equipes = array();

		$requete = "SELECT id, libelle FROM equipe ";
		$requete = $requete."WHERE not exists (select 1 from EQUIPE_TOURNOI et where et.EQUIPE=equipe.ID and et.TOURNOI='".$codeTournoi."') ";
		$requete = $requete."ORDER BY libelle desc";

		$q = $this->_db->query($requete);
		//$q->execute();

		while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
		{
			$equipes[] = new Equipe($donnees);
		}

		return $equipes;
	}

	public function trouverEquipesTournoi($codeTournoi)
	{
		// Retourne la liste des équipes inscrites au tournoi.
		// Le résultat sera un tableau d'instances de Equipe.

		$equipes = array();

		$requete = "SELECT id, libelle FROM equipe_tournoi et ";
		$requete = $requete."INNER JOIN equipe e ON (et.EQUIPE = e.ID)";
		$requete = $requete."WHERE et.TOURNOI = '".$codeTournoi."' ";
		$requete = $requete."ORDER BY libelle desc";

		$q = $this->_db->query($requete);
		//$q->execute();

		while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
		{
			$equipes[] = new Equipe($donnees);
		}

		return $equipes;
	}

	public function supprimerEquipesTournoi($codeTournoi)
	{
		// Exécute une requête de type DELETE.
		$this->_db->exec("DELETE FROM equipe_tournoi WHERE tournoi = '".$codeTournoi."'");
	}

	public function ajouterEquipe($libelle)
	{
		// Préparation de la requête d'insertion.
		$q = $this->_db->query("INSERT INTO equipe (LIBELLE, PHOTO, CLUB, DATE_CREATION, USER_MAJ, DERNIERE_MAJ) VALUES ('$libelle','-1', '-1',curdate(),'test',now())");
	}

	public function inscrireEquipeTournoi($codeTournoi, $idEquipe)
	{
		// Préparation de la requête d'insertion.
		$q = $this->_db->query("INSERT INTO equipe_tournoi (TOURNOI, EQUIPE, DATE_CREATION, USER_MAJ, DERNIERE_MAJ) VALUES ('$codeTournoi','$idEquipe', curdate(),'test',now())");
	}
}
?>