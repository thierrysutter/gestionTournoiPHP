<?php
function chargerClasse($classe) {
	require $classe . '.class.php'; // On inclut la classe correspondante au param�tre pass�.
}

spl_autoload_register('chargerClasse'); // On enregistre la fonction en autoload pour qu'elle soit appel�e d�s qu'on instanciera une classe non d�clar�e.

$logger = new Logger('logs/');
$logger->log('info', 'infos', "Entr�e dans AfficherTournoi.php", Logger::GRAN_MONTH);

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
	$idTournoi = $_GET['id'];
	$manager = new TournoiManager($db);
	$tournoi = $manager->trouverTournois($idTournoi);

	$managerCategorie = new CategorieManager($db);
	$categories = $managerCategorie->trouverCategories();

	$managerEquipe = new EquipeManager($db);
	$equipes = $managerEquipe->trouverEquipesTournoi($idTournoi);
/*
	$managerContact = new ContactManager($db);
	$contacts = $managerContact->trouverContacts($idClub);
*/
	// mise en session du club
	$_SESSION['tournoi'] = $tournoi[0];
	$_SESSION['categories'] = $categories;
	$_SESSION['equipes'] = $equipes;

	header("Location: ficheTournoi.php");
} catch (PDOException $error) { //Le catch est charge d'intercepter une eventuelle erreur
	echo "N° : ".$error->getCode()."<br />";
	die ("Erreur : ".$error->getMessage()."<br />");
	$messageErreur = "Erreur lors de la cr�ation/modification du tournoi.";
	$_SESSION['messageErreur'] = $messageErreur;
	header("Location: AfficherListeTournois.php");
}
?>