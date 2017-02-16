<?php
function chargerClasse($classe) {
	require $classe . '.class.php'; // On inclut la classe correspondante au paramètre passé.
}

spl_autoload_register('chargerClasse'); // On enregistre la fonction en autoload pour qu'elle soit appelée dès qu'on instanciera une classe non déclarée.

$logger = new Logger('logs/');
$logger->log('info', 'infos', "Entrée dans SupprimerTournoi.php", Logger::GRAN_MONTH);

ob_start();
session_start();
if (!isset($_SESSION['session_started'])) {
	header("location:index.php");
}

require_once("config/config.php");

// création de la connexion au serveur de base de données
$logger->log('info', 'infos', "Ouverture de la connexion à la base de données.", Logger::GRAN_MONTH);
$db = new PDO('mysql:host='.$db_host.';dbname='.$db_name, $db_login, $db_password);
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); // On émet une alerte à chaque fois qu'une requête a échoué.
$idTournoi = $_GET[id];
$manager = new TournoiManager($db);
$manager->supprimerTournoi($idTournoi);
header("Location: AfficherListeTournois.php");
?>