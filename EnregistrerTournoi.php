<?php
function chargerClasse($classe) {
	require $classe . '.class.php'; // On inclut la classe correspondante au paramètre passé.
}

spl_autoload_register('chargerClasse'); // On enregistre la fonction en autoload pour qu'elle soit appelée dès qu'on instanciera une classe non déclarée.

$logger = new Logger('logs/');
$logger->log('info', 'infos', "Entrée dans EnregistrerTournoi.php", Logger::GRAN_MONTH);

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

	$nom = $_POST[nom];
	$numAffiliation = $_POST[numAffiliation];
	$ligue = $_POST[ligue];
	$district = $_POST[district];
	$logo = $_POST[logo];
	$siteWeb = $_POST[siteWeb];
	$stade = $_POST[stade];
	$couleur1= $_POST[couleur1];
	$couleur2 = $_POST[couleur2];
	$adresse = $_POST[adresse];
	$adresse2 = $_POST[adresse2];
	$adresse3 = $_POST[adresse3];
	$codePostal = $_POST[codePostal];
	$ville = $_POST[ville];
	$pays = $_POST[pays];
	$tel1 = $_POST[tel1];
	$tel2 = $_POST[tel2];
	$fax1 = $_POST[fax1];
	$fax2 = $_POST[fax2];
	$email1 = $_POST[email1];
	$email2 = $_POST[email2];

	$manager = new TournoiManager($db);

	if ($mode == 'creation') {
		$manager->ajouterTournoi($nom, $numAffiliation, $ligue, $district, /*$logo*/-1, $siteWeb, $adresse,
			$adresse2, $adresse3, $codePostal, $ville, $pays, $email1, $email2,
			$tel1, $tel2, $fax1, $fax2, $stade, $couleur1, $couleur2);
	} else {
		$id = $_POST[id];
		$manager->mettreAJourTournoi($id, $nom, $numAffiliation, $ligue, $district, /*$logo*/-1, $siteWeb, $adresse,
			$adresse2, $adresse3, $codePostal, $ville, $pays, $email1, $email2,
			$tel1, $tel2, $fax1, $fax2, $stade, $couleur1, $couleur2);
	}
	header("Location: AfficherListeTournois.php");


} catch (PDOException $error) { //Le catch est charge d'intercepter une eventuelle erreur
	echo "NÂ° : ".$error->getCode()."<br />";
	die ("Erreur : ".$error->getMessage()."<br />");
	$messageErreur = "Erreur lors de la création/modification du tournoi.";
	$_SESSION['messageErreur'] = $messageErreur;
	header("Location: ajouterTournoi.php");
}






?>