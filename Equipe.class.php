<?php
class Equipe {
	// ATTRIBUTS PRIVES
	private $_id;
	private $_libelle;
	private $_photo;
	private $_club;


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

	public function setPhoto($photo) {
		$photo = (int) $photo;
		$this->_photo = $photo;
	}

	public function setClub($club) {
		$club = (int) $club;
		$this->_club = $club;
	}

	// GETTER
	public function getId() {
		return $this->_id;
	}

	public function getLibelle() {
		return $this->_libelle;
	}

	public function getPhoto() {
		return $this->_photo;
	}

	public function getClub() {
		return $this->_club;
	}

	public function __construct(array $donnees) {
		$this->hydrate($donnees);
	}

	// HYDRATATION
	// Un tableau de donn�es doit �tre pass� � la fonction (d'o� le pr�fixe � array �).
	public function hydrate(array $donnees) {
		echo "Entr�e dans l'hydratation de la classe Equipe<br>";
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