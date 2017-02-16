<?php
class GroupeManager {
	private $_db;

	public function __construct($db)
	{
		$this->setDb($db);
	}

	public function setDb(PDO $db)
	{
		$this->_db = $db;
	}

	public function trouverGroupes()
	{
		// Retourne la liste des groupes.
		// Le résultat sera un tableau d'instances de Groupe.

		$groupes = array();

		$q = $this->_db->query("SELECT tournoi, libelle FROM groupe_tournoi ORDER BY tournoi, libelle desc");
		//$q->execute();

		while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
		{
			$groupes[] = new Groupe($donnees);
		}

		return $groupes;
	}

	public function trouverGroupesTournoi($codeTournoi)
	{
		// Retourne la liste des groupes du tournoi.
		// Le résultat sera un tableau d'instances de Groupe.

		$groupes = array();

		$q = $this->_db->query("SELECT tournoi, libelle FROM groupe_tournoi WHERE tournoi='".$codeTournoi."' ORDER BY libelle desc");
		//$q->execute();

		while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
		{
			$groupes[] = new Groupe($donnees);
		}

		return $groupes;
	}

	public function ajouterEquipeGroupeTournoi($codeTournoi, $libelleGroupe, $listeEquipes)
	{
		foreach ($listeEquipes as &$equipe) {

			// Préparation de la requête d'insertion.
			$q = $this->_db->query("INSERT INTO equipe_groupe_tournoi (TOURNOI, GROUPE, EQUIPE, DATE_CREATION, USER_MAJ, DERNIERE_MAJ) VALUES ('".$codeTournoi."', '".$libelleGroupe."', '".$equipe->getId()."', curdate(),'test',now())");
		}
		unset($equipe);
	}

	public function supprimerGroupesTournoi($codeTournoi)
	{
		// Exécute une requête de type DELETE.
		$this->_db->exec("DELETE FROM groupe_tournoi WHERE tournoi = '".$codeTournoi."'");
	}

	public function ajouterGroupeTournoi($codeTournoi, $libelleGroupe)
	{
		// Exécute une requête de type DELETE.
		$this->_db->exec("INSERT INTO groupe_tournoi (TOURNOI, LIBELLE, DATE_CREATION, USER_MAJ, DERNIERE_MAJ) VALUES ('".$codeTournoi."', '".$libelleGroupe."', curdate(),'test',now())");
	}
}
?>