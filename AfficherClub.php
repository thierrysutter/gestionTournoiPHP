<?php
function chargerClasse($classe) {
	require $classe . '.class.php'; // On inclut la classe correspondante au param�tre pass�.
}

spl_autoload_register('chargerClasse'); // On enregistre la fonction en autoload pour qu'elle soit appel�e d�s qu'on instanciera une classe non d�clar�e.

$logger = new Logger('logs/');
$logger->log('info', 'infos', "Entr�e dans AfficherClub.php", Logger::GRAN_MONTH);

ob_start();
session_start();
if (!isset($_SESSION['session_started'])) {
	header("location:index.php");
}

require_once("config/config.php");
try {
	// cr�ation de la connexion au serveur de base de donn�es
	$logger->log('info', 'infos', "Ouverture de la connexion � la base de donn�es.", Logger::GRAN_MONTH);
	$db = new PDO('mysql:host='.$db_host.';dbname='.$db_name, $db_login, $db_password);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); // On �met une alerte � chaque fois qu'une requ�te a �chou�.
	$idClub = $_GET['id'];
	$manager = new ClubManager($db);
	$club = $manager->trouverClubs($idClub);
	
	$managerTerrain = new TerrainManager($db);
	$terrains = $managerTerrain->trouverTerrains($idClub);
	
	$managerContact = new ContactManager($db);
	$contacts = $managerContact->trouverContacts($idClub);
	
	// mise en session du club
	$_SESSION['club'] = $club[0];
	$_SESSION['terrains'] = $terrains;
	$_SESSION['contacts'] = $contacts;
	
	header("Location: ficheClub.php");
} catch (PDOException $error) { //Le catch est charge d'intercepter une eventuelle erreur
	echo "N° : ".$error->getCode()."<br />";
	die ("Erreur : ".$error->getMessage()."<br />");
	$messageErreur = "Erreur lors de la cr�ation/modification du terrain.";
	$_SESSION['messageErreur'] = $messageErreur;
	header("Location: AfficherListeClubs.php");
}
?>