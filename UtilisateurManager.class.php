<?php
class UtilisateurManager {
	private $_db;

	public function __construct($db)
	{
		$this->setDb($db);
	}

	public function setDb(PDO $db)
	{
		$this->_db = $db;
	}

	public function getList()
	{
		// Retourne la liste des utilisateurs.
		// Le résultat sera un tableau d'instances de Utilisateur.

		$utilisateurs = array();

		$q = $this->_db->query("SELECT id FROM user ORDER BY id desc");
		//$q->execute();

		while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
		{
			$utilisateurs[] = new Utilisateur($donnees);
		}

		return $utilisateurs;
	}

	public function trouverCompteUtilisateurParLogin($login)
	{
		// Retourne la liste des utilisateurs.
		// Le résultat sera un tableau d'instances de Utilisateur.

		$utilisateurs = array();

		$q = $this->_db->query("SELECT id FROM user WHERE login = '".$login."' ORDER BY id desc");
		//$q->execute();

		while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
		{
			$utilisateurs[] = new Utilisateur($donnees);
		}

		return $utilisateurs;
	}

	public function tracerEchecConnexion($id)
	{
		// Prépare une requête de type UPDATE.
		$q = $this->_db->query("UPDATE user SET NB_ECHEC = NB_ECHEC + 1, date_maj = now() WHERE id = '".$id."'");
	}

	public function tracerConnexion($id)
	{
		// Prépare une requête de type UPDATE.
		$q = $this->_db->query("UPDATE user SET DATE_DERNIERE_CONNEXION = curdate(), NB_ECHEC = 0, date_maj = now() WHERE id = '".$id."'");
	}
}
?>