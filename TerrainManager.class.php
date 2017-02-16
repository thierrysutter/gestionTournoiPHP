<?php
class TerrainManager {
	private $_db;

	public function __construct($db)
	{
		$this->setDb($db);
	}

	public function setDb(PDO $db)
	{
		$this->_db = $db;
	}

	public function trouverTerrains($idClub)
	{
		// Retourne la liste des terrain d'un club.
		// Le résultat sera un tableau d'instances de Terrain.

		$terrains = array();

		$requete = "SELECT t.club, t.libelle, t.type ";
		$requete = $requete."FROM terrain t ";

		if($codeClub > 0) {
			$requete = $requete."WHERE t.club = '$idClub' ";
		}

		$requete = $requete."ORDER BY t.libelle asc ";

		$q = $this->_db->query($requete);

		while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
		{
			$terrains[] = new Terrain($donnees);
		}
		return $terrains;
	}
	
	public function trouverTerrain($idClub, $libelle)
	{
		// Retourne le terrain d'un club.
		// Le résultat sera un tableau d'instances de Terrain.

		$terrains = array();

		$requete = "SELECT t.club, t.libelle, t.type ";
		$requete = $requete."FROM terrain t ";
		$requete = $requete."WHERE t.club = '$idClub' AND t.libelle = '$libelle'";

		$q = $this->_db->query($requete);

		while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
		{
			$terrains[] = new Terrain($donnees);
		}
		return $terrains[0];
	}

	public function ajouterTerrain($idClub, $libelle, $type)
	{echo "ajout du terrain: $idClub $libelle $type<br>";
		// Préparation de la requête d'insertion.
		$requete = "INSERT INTO terrain (CLUB, LIBELLE, TYPE, DATE_CREATION, USER_MAJ, DERNIERE_MAJ) "
			."VALUES ('$idClub',upper('$libelle'), upper('$type'), curdate(), 'test', now())";

		$q = $this->_db->query($requete);
	}

	public function mettreAJourTerrain($idClub, $libelleInit, $libelle, $type)
	{
		// Préparation de la requête d'insertion.
		/*$requete = "UPDATE terrain "
			."SET CLUB='$idClub', LIBELLE=upper('$libelle'), TYPE=upper('$type'), "
			."USER_MAJ='test', DERNIERE_MAJ=now() "
			."WHERE CLUB='$idClub' AND LIBELLE='$libelle'";

		$q = $this->_db->query($requete);
		*/


		$this->supprimerTerrain($idClub, $libelleInit);
		$this->ajouterTerrain($idClub, $libelle, $type);
		
	}

	public function supprimerTerrain($idClub, $libelle)
	{
		echo "suppression du terrain: $idClub $libelle<br>";
		// Exécute une requête de type DELETE.
		$requete = "DELETE FROM terrain WHERE club = '$idClub' and libelle = '$libelle'";

		$this->_db->exec($requete);
	}
}
?>