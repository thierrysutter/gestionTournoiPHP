<?php
class Terrain {
	// ATTRIBUTS PRIVES
	private $_club;
	private $_libelle;
	private $_type;

	//SETTER
	public function setClub($club) {
		$id = (int) $club;
		$this->_club = $club;
	}

	public function setLibelle($libelle) {
		if (is_string($libelle)) {
			$this->_libelle= $libelle;
		}
	}

	public function setType($type) {
		if (is_string($type)) {
			$this->_type= $type;
		}
	}

	// GETTER
	public function getClub() {
		return $this->_club;
	}

	public function getLibelle() {
		return $this->_libelle;
	}

	public function getType() {
		return $this->_type;
	}

	// CONSTRUCTEUR
	public function __construct(array $donnees) {
		$this->hydrate($donnees);
	}

	// HYDRATATION
	// Un tableau de donn�es doit �tre pass� � la fonction (d'o� le pr�fixe � array �).
	public function hydrate(array $donnees) {
		//echo "Entr�e dans l'hydratation de la classe Club<br>";

		foreach ($donnees as $key => $value) {
			// On r�cup�re le nom du setter correspondant � l'attribut.
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