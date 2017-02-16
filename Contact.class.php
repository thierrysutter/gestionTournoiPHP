<?php
class Contact {
	// ATTRIBUTS PRIVES
	private $_club;
	private $_fonction;
	private $_nom;
	private $_prenom;
	private $_adresse1;
	private $_adresse2;
	private $_adresse3;
	private $_codePostal;
	private $_ville;
	private $_pays;
	private $_tel;
	private $_email;

	//SETTER
	public function setClub($club) {
		$id = (int) $club;
		$this->_club = $club;
	}

	public function setFonction($fonction) {
		if (is_string($fonction)) {
			$this->_fonction= $fonction;
		}
	}

	public function setNom($nom) {
		if (is_string($nom)) {
			$this->_nom= $nom;
		}
	}

	public function setPrenom($prenom) {
		if (is_string($prenom)) {
			$this->_prenom= $prenom;
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

	public function setEmail($email) {
		if (is_string($email)) {
			$this->_email = $email;
		}
	}

	public function setTel($tel) {
		if (is_string($tel)) {
			$this->_tel = $tel;
		}
	}

	// GETTER
	public function getClub() {
		return $this->_club;
	}

	public function getFonction() {
		return $this->_fonction;
	}

	public function getNom() {
		return $this->_nom;
	}

	public function getPrenom() {
		return $this->_prenom;
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

	public function getEmail() {
		return $this->_email;
	}

	public function getTel() {
		return $this->_tel;
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