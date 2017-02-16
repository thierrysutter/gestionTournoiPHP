<?php
require_once("config/config.php");
class Bdd {
	// ATTRIBUTS PRIVES
	private $_result;
	
	// SETTER
	public function setResult($result) {
		$this->_result = $result;
	}
	
	// GETTER
	public function getResult() {
		return $this->_result;
	}
	
	// CONSTRUCTEUR
	public function __construct($db_host, $db_login, $db_password, $db_name) {
		$this->ouvrirConnexionBdd($db_host, $db_login, $db_password);
		$this->selectionBdd($db_name);
	}
  
	// METHODES
	public function ouvrirConnexionBdd($db_host, $db_login, $db_password) {
		echo("Connection au serveur de base de données<br>");
		mysql_connect($db_host, $db_login, $db_password) or die ("Connexion impossible au serveur dans case login");
	}
	
	public function selectionBdd($db_name) {
		echo("Sélection de la base de données<br>");
		mysql_select_db("$db_name")or die("cannot select DB");
	}

	public function executerRequeteSelect($sql) {
		echo("Execution de la requete: ".$sql."<br>");
		$res = mysql_query($sql) or die ("Echec de la requête : ".$sql);
		$this->setResult($res);
	}
	
	public function executerRequeteIUD($sql) {
		echo("Execution de la requete: ".$sql."<br>");
		return mysql_query($sql) or die ("Echec de la requête : ".$sql);		
	}
	
	public function getNbResultats() {
		return mysql_num_rows($this->_result);
	}
}
?>