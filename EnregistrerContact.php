<?php
function chargerClasse($classe) {
	require $classe . '.class.php'; // On inclut la classe correspondante au paramètre passé.
}

spl_autoload_register('chargerClasse'); // On enregistre la fonction en autoload pour qu'elle soit appelée dès qu'on instanciera une classe non déclarée.

$logger = new Logger('logs/');
$logger->log('info', 'infos', "Entrée dans EnregistrerContact.php", Logger::GRAN_MONTH);

ob_start();
session_start();
if (!isset($_SESSION['session_started'])) {
	header("location:index.php");
}

require_once("config/config.php");

// crÃ©ation de la connexion au serveur de base de données
$logger->log('info', 'infos', "Ouverture de la connexion a la base de donnees.", Logger::GRAN_MONTH);
try {

	$db = new PDO('mysql:host='.$db_host.';dbname='.$db_name, $db_login, $db_password);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // On Ã©met une alerte Ã  chaque fois qu'une requÃªte a Ã©chouÃ©.
	$db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);

	$mode = $_POST[mode];
	$idClub = $_POST[idClub];
	$fonction = $_POST[fonction];
	$nom = $_POST[nom];
	$prenom = $_POST[prenom];
	$adresse = $_POST[adresse];
	$adresse2 = $_POST[adresse2];
	$adresse3 = $_POST[adresse3];
	$codePostal = $_POST[codePostal];
	$ville = $_POST[ville];
	$pays = $_POST[pays];
	$tel = $_POST[tel];
	$email = $_POST[email];


	$manager = new ContactManager($db);

	if ($mode == 'creation') {
		$manager->ajouterContact($idClub, $fonction, $nom, $prenom, $adresse,
			$adresse2, $adresse3, $codePostal, $ville, $pays, $email, $tel);
	} else {
		$manager->mettreAJourContact($idClub, $fonction, $nom, $prenom, $adresse,
			$adresse2, $adresse3, $codePostal, $ville, $pays, $email, $tel);
	}
	header("Location: AfficherClub.php?id=$idClub");



} catch (PDOException $error) { //Le catch est charge d'intercepter une eventuelle erreur
	echo "NÂ° : ".$error->getCode()."<br />";
	die ("Erreur : ".$error->getMessage()."<br />");
	$messageErreur = "Erreur lors de la création/modification du contact.";
	$_SESSION['messageErreur'] = $messageErreur;
	header("Location: AfficherClub.php?id=$idClub");

}






?>