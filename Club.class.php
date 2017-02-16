<?php
class Club {
	// ATTRIBUTS PRIVES
	private $_id;
	private $_nom;
	private $_numAffiliation;
	private $_ligue;
	private $_district;
	private $_logo;
	private $_siteWeb;
	private $_adresse1;
	private $_adresse2;
	private $_adresse3;
	private $_codePostal;
	private $_ville;
	private $_pays;
	private $_email1;
	private $_email2;
	private $_tel1;
	private $_tel2;
	private $_fax1;
	private $_fax2;
	private $_stade;
	private $_couleur1;
	private $_couleur2;
	
	private $_contacts;
	private $_terrains;

	//SETTER
	public function setId($id) {
		$id = (int) $id;
		$this->_id = $id;
	}

	public function setNom($nom) {
		if (is_string($nom)) {
			$this->_nom= $nom;
		}
	}

	public function setNumAffiliation($numAffiliation) {
		$numAffiliation = (int) $numAffiliation;
		$this->_numAffiliation = $numAffiliation;
	}

	public function setLigue($ligue) {
		if (is_string($ligue)) {
			$this->_ligue = $ligue;
		}
	}

	public function setDistrict($district) {
		if (is_string($district)) {
			$this->_district = $district;
		}
	}
	
	public function setLogo($logo) {
		/*if (is_string($logo)) {
			$this->_logo = $logo;
		}*/
		$logo = (int) $logo;
		$this->_logo = $logo;
	}

	public function setSiteWeb($siteWeb) {
	if (is_string($siteWeb)) {
			$this->_siteWeb = $siteWeb;
		}
	}

	public function setAdresse1($adresse1) {
		if (is_string($adresse1)) {
			$this->_adresse1 = $adresse1;
		}
	}

	public function setAdresse2($adresse2) {
		if (is_string($adresse2)) {
			$this->_adresse2 = $adresse2;
		}
	}

	public function setAdresse3($adresse3) {
		if (is_string($adresse3)) {
			$this->_adresse3 = $adresse3;
		}
	}

	public function setCodePostal($codePostal) {
		if (is_string($codePostal)) {
			$this->_codePostal = $codePostal;
		}
	}

	public function setVille($ville) {
		if (is_string($ville)) {
			$this->_ville = $ville;
		}
	}

	public function setPays($pays) {
		if (is_string($pays)) {
			$this->_pays = $pays;
		}
	}

	public function setEmail1($email1) {
		if (is_string($email1)) {
			$this->_email1 = $email1;
		}
	}

	public function setTel1($tel1) {
		if (is_string($tel1)) {
			$this->_tel1 = $tel1;
		}
	}

	public function setFax1($fax1) {
		if (is_string($fax1)) {
			$this->_fax1 = $fax1;
		}
	}

	public function setEmail2($email2) {
		if (is_string($email2)) {
			$this->_email2 = $email2;
		}
	}

	public function setTel2($tel2) {
		if (is_string($tel2)) {
			$this->_tel2 = $tel2;
		}
	}

	public function setFax2($fax2) {
		if (is_string($fax2)) {
			$this->_fax2 = $fax2;
		}
	}

	public function setStade($stade) {
		if (is_string($stade)) {
			$this->_stade = $stade;
		}
	}

	public function setCouleur1($couleur1) {
		if (is_string($couleur1)) {
			$this->_couleur1 = $couleur1;
		}
	}

	public function setCouleur2($couleur2) {
		if (is_string($couleur2)) {
			$this->_couleur2 = $couleur2;
		}
	}

	public function setContacts($contacts) {
		$this->_contacts = $contacts;
	}
	
	public function setTerrains($terrains) {
		$this->_terrains = $terrains;
	}
	
	// GETTER
	public function getId() {
		return $this->_id;
	}

	public function getNom() {
		return $this->_nom;
	}

	public function getNumAffiliation() {
		return $this->_numAffiliation;
	}

	public function getLigue() {
		return $this->_ligue;
	}

	public function getDistrict() {
		return $this->_district;
	}

	public function getLogo() {
		return $this->_logo;
	}

	public function getSiteWeb() {
		return $this->_siteWeb;
	}

	public function getAdresse1() {
		return $this->_adresse1;
	}

	public function getAdresse2() {
		return $this->_adresse2;
	}

	public function getAdresse3() {
		return $this->_adresse3;
	}

	public function getCodePostal() {
		return $this->_codePostal;
	}

	public function getVille() {
		return $this->_ville;
	}

	public function getPays() {
		return $this->_pays;
	}

	public function getEmail1() {
		return $this->_email1;
	}

	public function getTel1() {
		return $this->_tel1;
	}

	public function getFax1() {
		return $this->_fax1;
	}

	public function getEmail2() {
		return $this->_email2;
	}

	public function getTel2() {
		return $this->_tel2;
	}

	public function getFax2() {
		return $this->_fax2;
	}

	public function getStade() {
		return $this->_stade;
	}

	public function getCouleur1() {
		return $this->_couleur1;
	}

	public function getCouleur2() {
		return $this->_couleur2;
	}
	
	public function getContacts() {
		return $this->_contacts;
	}

	public function getTerrains() {
		return $this->_terrains;
	}

	// CONSTRUCTEUR
	public function __construct(array $donnees) {
		$this->hydrate($donnees);
	}

	// HYDRATATION
	// Un tableau de données doit être passé à la fonction (d'où le préfixe « array »).
	public function hydrate(array $donnees) {
		//echo "Entrée dans l'hydratation de la classe Club<br>";

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