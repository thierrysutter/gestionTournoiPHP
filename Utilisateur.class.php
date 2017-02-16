<?php
class Utilisateur {
	// DONNEES STATIQUES
	public static $nbEssaiConnexion = 3; // nb d'échec de connexions toléré avant verrouillage du compte
	public static $nbMoisAvantExpirationPwd = 6; // durée de validité (en mois) d'un mot de passe avant expiration
	public static $nbMinCaracPwd = 6; // nb minimum de caractères d'un mot de passe
	public static $nbMaxCaracPwd = 25; // nb maximum de caractères d'un mot de passe
	public static $forcerMinusculePwd = true; // indique si le mot de passe doit contenir au moins une lettre en minuscule A->Z
	public static $forcerMajusculePwd = true; // indique si le mot de passe doit contenir au moins une lettre en majuscule A->Z
	public static $forcerChiffrePwd = true; // ndique si le mot de passe doit contenir au moins 1 chiffre 0-9
	public static $forcerSpecialPwd = true; // indique si le mot de passe doit contenir au moins un caractère spécial @#$%
	public static $listeCaracPwd = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"; // liste des caractères alphannumériques autorisés
	public static $listeCaracSpecialPwd = "@ # $ %"; // liste des caractères spéciaux autorisés (séparés par des espaces

	// ATTRIBUTS PRIVES
	private $_id;
	private $_login;
	private $_password; // mot de passe hashé !! (en  utilisant l'id comme clé de hashage)
	private $_pwdUsageUnique;
	private $_actif;
	private $_nbEchec;
	private $_dateDerniereConnexion;
	private $_dateExpiration;
	private $_email;
	private $_cguApprouve;

	//SETTER
	public function setId($id) {
		$id = (int) $id;
		$this->_id = $id;
	}

	public function setLogin($login) {
		if (is_string($login)) {
			$this->_login = $login;
		}
	}

	public function setPassword($password) {
		if (is_string($password)) {
			$this->_password = $password;
		}
	}

	public function setPwdUsageUnique($pwdUsageUnique) {
		$pwdUsageUnique = (int) $pwdUsageUnique;
		$this->_pwdUsageUnique = $pwdUsageUnique;
	}

	public function setActif($actif) {
		$actif = (int) $actif;
		$this->_actif = $actif;
	}

	public function setNbEchec($nbEchec) {
		$nbEchec = (int) $nbEchec;
		$this->_nbEchec = $nbEchec;
	}

	public function setDateDerniereConnexion($dateDerniereConnexion) {
		if (is_date($dateDerniereConnexion)) {
			$this->_dateDerniereConnexion = $dateDerniereConnexion;
		}
	}

	public function setDateExpiration($dateExpiration) {
		if (is_date($dateExpiration)) {
			$this->_dateExpiration = $dateExpiration;
		}
	}

	public function setEmail($email) {
		if (is_string($email)) {
			$this->_email = $email;
		}
	}

	public function setCguApprouve($cguApprouve) {
		if (is_bool($cguApprouve)) {
			$this->_cguApprouve = $cguApprouve;
		}
	}

	// GETTER
	public function getId() {
		return $this->_id;
	}

	public function getLogin() {
		return $this->_login;
	}

	public function getPassword() {
		return $this->_password;
	}

	public function getPwdUsageUnique() {
		return $this->_pwdUsageUnique;
	}

	public function getActif() {
		return $this->_actif;
	}

	public function getNbEchec() {
		return $this->_nbEchec;
	}

	public function getDateDerniereConnexion() {
		return $this->_dateDerniereConnexion;
	}

	public function getDateExpiration() {
		return $this->_dateExpiration;
	}

	public function getEmail() {
		return $this->_email;
	}

	public function getCguApprouve() {
		return $this->_cguApprouve;
	}

	//CONSTRUCTEUR
	public function __construct(array $donnees) {
		$this->hydrate($donnees);
	}

	// HYDRATATION
	// Un tableau de données doit être passé à la fonction (d'où le préfixe « array »).
	public function hydrate(array $donnees) {
		echo "Entrée dans l'hydratation de la classe Utilisateur<br>";
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