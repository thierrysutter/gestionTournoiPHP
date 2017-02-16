<?php
class CategorieManager {
	private $_db;

	public function __construct($db)
	{
		$this->setDb($db);
	}

	public function setDb(PDO $db)
	{
		$this->_db = $db;
	}

	public function trouverCategories()
	{
		// Retourne la liste des catégories.
		// Le résultat sera un tableau d'instances de Categorie.

		$categories = array();

		$q = $this->_db->query("SELECT id, libelle FROM categorie ORDER BY id desc");
		//$q->execute();

		while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
		{
			$categories[] = new Categorie($donnees);
		}

		return $categories;
	}
}
?>