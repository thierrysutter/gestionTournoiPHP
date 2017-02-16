<?php
class Groupe {
	// ATTRIBUTS PRIVES
	private $_codeTournoi;
	private $_libelle;

	private $_listeEquipes;

	//SETTER
	public function setCodeTournoi($codeTournoi) {
		$id = (int) $codeTournoi;
		$this->_codeTournoi = $codeTournoi;
	}

	public function setLibelle($libelle) {
		if (is_string($libelle)) {
			$this->_libelle = $libelle;
		}
	}

	public function setListeEquipes($listeEquipes) {
		$this->_listeEquipes = $listeEquipes;
	}

	// GETTER
	public function getCodeTournoi() {
		return $this->_codeTournoi;
	}

	public function getLibelle() {
		return $this->_libelle;
	}

	public function getListeEquipes() {
		return $this->_listeEquipes;
	}

	public function __construct(array $donnees) {
		$this->hydrate($donnees);
	}

	// HYDRATATION
	// Un tableau de données doit être passé à la fonction (d'où le préfixe « array »).
	public function hydrate(array $donnees) {
		echo "Entrée dans l'hydratation de la classe Groupe<br>";
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