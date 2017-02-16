<?php
class ContactManager {
	private $_db;

	public function __construct($db)
	{
		$this->setDb($db);
	}

	public function setDb(PDO $db)
	{
		$this->_db = $db;
	}

	public function trouverContacts($club) {
		// Retourne la liste des clubs.
		// Le résultat sera un tableau d'instances de Club.

		$contacts = array();

		$requete = "SELECT c.club, c.fonction, c.nom, c.prenom, ";
		$requete = $requete."c.adresse1, c.adresse2, c.adresse3, c.code_postal as codePostal, c.ville, c.pays, ";
		$requete = $requete."c.email, c.tel ";
		$requete = $requete."FROM contact c ";

		if($club > 0) {
			$requete = $requete."WHERE c.club = '".$club."' ";
		}

		$requete = $requete."ORDER BY c.nom asc ";

		$q = $this->_db->query($requete);

		while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
		{
			$contacts[] = new Contact($donnees);
		}
		return $contacts;
	}
	
	public function trouverContact($club, $nom) {
		// Retourne la liste des clubs.
		// Le résultat sera un tableau d'instances de Club.

		$contacts = array();

		$requete = "SELECT c.club, c.fonction, c.nom, c.prenom, ";
		$requete = $requete."c.adresse1, c.adresse2, c.adresse3, c.code_postal as codePostal, c.ville, c.pays, ";
		$requete = $requete."c.email, c.tel ";
		$requete = $requete."FROM contact c ";
		$requete = $requete."WHERE c.club = '$club' AND c.nom = '$nom'";

		$q = $this->_db->query($requete);

		while ($donnees = $q->fetch(PDO::FETCH_ASSOC))
		{
			$contacts[] = new Contact($donnees);
		}
		return $contacts[0];
	}

	public function ajouterContact($club, $fonction, $nom, $prenom, $adresse1, $adresse2, $adresse3, $codePostal, $ville, $pays, $email, $tel)
	{
		// Préparation de la requête d'insertion.
		$requete = "INSERT INTO contact (CLUB, FONCTION, NOM, PRENOM, ADRESSE1, "
			."ADRESSE2, ADRESSE3, CODE_POSTAL, VILLE, PAYS, EMAIL, TEL, "
			."DATE_CREATION, USER_MAJ, DERNIERE_MAJ) "
			."VALUES ('$club', upper('$fonction'), upper('$nom'), upper('$prenom'), upper('$adresse1'), "
			."upper('$adresse2'),upper('$adresse3'), upper('$codePostal'), upper('$ville'), upper('$pays'), '$email', "
			."'$tel', curdate(), 'test', now())";

		$q = $this->_db->query($requete);
	}

	public function mettreAJourContact($club, $fonction, $nom, $prenom, $adresse1, $adresse2, $adresse3, $codePostal, $ville, $pays, $email, $tel)
	{
		// Préparation de la requête d'insertion.
		$requete = "UPDATE contact "
			."SET CLUB='$club', FONCTION=upper('$fonction'), NOM=upper('$nom'), PRENOM=upper('$prenom'), ADRESSE1=upper('$adresse1'), "
			."ADRESSE2=upper('$adresse2'), ADRESSE3=upper('$adresse3'), CODE_POSTAL=upper('$codePostal'), VILLE=upper('$ville'), PAYS=upper('$pays'), EMAIL='$email', "
			."TEL='$tel', "
			."USER_MAJ='test', DERNIERE_MAJ=now() "
			."WHERE CLUB='$club' ";

		$q = $this->_db->query($requete);
	}

	public function supprimerContact($club, $nom)
	{
		// Exécute une requête de type DELETE.
		$requete = "DELETE FROM contact WHERE club = '$club' and nom = '$nom'";
		$this->_db->exec($requete);
	}

	/*public function changerStatutTournoi($codeTournoi, $nouveauStatut)
	{
		// Prépare une requête de type UPDATE.
		$q = $this->_db->query("UPDATE tournoi SET statut = '".$nouveauStatut."', DERNIERE_MAJ = now() WHERE id = '".$codeTournoi."'");
	}*/
}
?>