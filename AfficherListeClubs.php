<?php
function chargerClasse($classe) {
	require $classe . '.class.php'; // On inclut la classe correspondante au param�tre pass�.
}

spl_autoload_register('chargerClasse'); // On enregistre la fonction en autoload pour qu'elle soit appel�e d�s qu'on instanciera une classe non d�clar�e.

$logger = new Logger('logs/');
$logger->log('info', 'infos', "Entr�e dans AfficherListeClubs.php", Logger::GRAN_MONTH);

ob_start();
session_start();
if (!isset($_SESSION['session_started'])) {
	header("location:index.php");
}

require_once("config/config.php");

// cr�ation de la connexion au serveur de base de donn�es
$logger->log('info', 'infos', "Ouverture de la connexion � la base de donn�es.", Logger::GRAN_MONTH);
$db = new PDO('mysql:host='.$db_host.';dbname='.$db_name, $db_login, $db_password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); // On �met une alerte � chaque fois qu'une requ�te a �chou�.

$manager = new ClubManager($db);
$listeClubs = $manager->trouverClubs(0);
// mise en session de la liste des membres
$_SESSION['listeClubs'] = $listeClubs;
header("Location: listeClubs.php");
?>