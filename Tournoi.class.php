<?php
class Tournoi {
	// ATTRIBUTS PRIVES
	private $_id;
	private $_libelle;
	private $_statut;
	private $_libelleStatut;

	private $_dateTournoi;
	private $_typeTournoi;
	private $_libelleTypeTournoi;
	private $_categorie;
	private $_description;
	private $_libelleCategorie;
	private $_lieu;
	private $_reglement;
	private $_plaquette;
	private $_nbEquipes;
	private $_nbTerrains;
	private $_dureeRencontre;
	private $_baremeVictoire;
	private $_baremeNul;
	private $_baremeDefaite;
	private $_nbGroupes;
	private $_nbEquipesQualifiees;
	private $_consolante;

	//SETTER
	public function setId($id) {
		$id = (int) $id;
		$this->_id = $id;
	}

	public function setLibelle($libelle) {
		if (is_string($libelle)) {
			$this->_libelle = $libelle;
		}
	}

	public function setStatut($statut) {
		$statut = (int) $statut;
		$this->_statut = $statut;
	}

	public function setLibelleStatut($libelleStatut) {
		if (is_string($libelleStatut)) {
			$this->_libelleStatut = $libelleStatut;
		}
	}

	public function setDateTournoi($dateTournoi) {
		if (is_string($dateTournoi)) {
			$this->_dateTournoi = $dateTournoi;
		}
	}

	public function setTypeTournoi($typeTournoi) {
		$typeTournoi = (int) $typeTournoi;
		$this->_typeTournoi = $typeTournoi;
	}

	public function setLibelleTypeTournoi($libelleTypeTournoi) {
		if (is_string($libelleTypeTournoi)) {
			$this->_libelleTypeTournoi = $libelleTypeTournoi;
		}
	}

	public function setCategorie($categorie) {
		$categorie = (int) $categorie;
		$this->_categorie = $categorie;
	}

	public function setDescription($description) {
		if (is_string($description)) {
			$this->_description = $description;
		}
	}

	public function setLibelleCategorie($libelleCategorie) {
		if (is_string($libelleCategorie)) {
			$this->_libelleCategorie = $libelleCategorie;
		}
	}

	public function setLieu($lieu) {
		if (is_string($lieu)) {
			$this->_lieu = $lieu;
		}
	}

	public function setReglement($reglement) {
		$reglement = (int) $reglement;
		$this->_reglement = $reglement;
	}

	public function setPlaquette($plaquette) {
		$plaquette = (int) $plaquette;
		$this->_plaquette = $plaquette;
	}

	public function setNbEquipes($nbEquipes) {
		$nbEquipes = (int) $nbEquipes;
		$this->_nbEquipes = $nbEquipes;
	}

	public function setNbTerrains($nbTerrains) {
		$nbTerrains = (int) $nbTerrains;
		$this->_nbTerrains = $nbTerrains;
	}

	public function setDureeRencontre($dureeRencontre) {
		$dureeRencontre = (int) $dureeRencontre;
		$this->_dureeRencontre = $dureeRencontre;
	}

	public function setBaremeVictoire($baremeVictoire) {
		$baremeVictoire = (int) $baremeVictoire;
		$this->_baremeVictoire = $baremeVictoire;
	}

	public function setBaremeNul($baremeNul) {
		$baremeNul = (int) $baremeNul;
		$this->_baremeNul = $baremeNul;
	}

	public function setBaremeDefaite($baremeDefaite) {
		$baremeDefaite = (int) $baremeDefaite;
		$this->_baremeDefaite = $baremeDefaite;
	}

	public function setNbGroupes($nbGroupes) {
		$nbGroupes = (int) $nbGroupes;
		$this->_nbGroupes = $nbGroupes;
	}

	public function setNbEquipesQualifiees($nbEquipesQualifiees) {
		$nbEquipesQualifiees = (int) $nbEquipesQualifiees;
		$this->_nbEquipesQualifiees = $nbEquipesQualifiees;
	}

	public function setConsolante($consolante) {
		$consolante = (int) $consolante;
		$this->_consolante = $consolante;
	}

	// GETTER
	public function getId() {
		return $this->_id;
	}

	public function getLibelle() {
		return $this->_libelle;
	}

	public function getStatut() {
		return $this->_statut;
	}

	public function getLibelleStatut() {
		return $this->_libelleStatut;
	}

	public function getDateTournoi() {
		return $this->_dateTournoi;
	}

	public function getTypeTournoi() {
		return $this->_typeTournoi;
	}

	public function getLibelleTypeTournoi() {
		return $this->_libelleTypeTournoi;
	}

	public function getCategorie() {
		return $this->_categorie;
	}

	public function getDescription() {
		return $this->_description;
	}

	public function getLibelleCategorie() {
		return $this->_libelleCategorie;
	}

	public function getLieu() {
		return $this->_lieu;
	}

	public function getReglement() {
		return $this->_reglement;
	}

	public function getPlaquette() {
		return $this->_plaquette;
	}

	public function getNbEquipes() {
		return $this->_nbEquipes;
	}

	public function getNbTerrains() {
		return $this->_nbTerrains;
	}

	public function getDureeRencontre() {
		return $this->_dureeRencontre;
	}

	public function getBaremeVictoire() {
		return $this->_baremeVictoire;
	}

	public function getBaremeNul() {
		return $this->_baremeNul;
	}

	public function getBaremeDefaite() {
		return $this->_baremeDefaite;
	}

	public function getNbGroupes() {
		return $this->_nbGroupes;
	}

	public function getNbEquipesQualifiees() {
		return $this->_nbEquipesQualifiees;
	}

	public function getConsolante() {
		return $this->_consolante;
	}

	// CONSTRUCTEUR
	public function __construct(array $donnees) {
		$this->hydrate($donnees);
	}

	// HYDRATATION
	// Un tableau de données doit être passé à la fonction (d'où le préfixe « array »).
	public function hydrate(array $donnees) {
		//echo "Entrée dans l'hydratation de la classe Tournoi<br>";

		foreach ($donnees as $key => $value) {
			// On récupère le nom du setter correspondant à l'attribut.
			$method = 'set'.ucfirst($key);
			// Si le setter correspondant existe.

			if (method_exists($this, $method))
			{
				// On appelle le setter.
				$this->$method($value);
			}
		}
	}
}
?>