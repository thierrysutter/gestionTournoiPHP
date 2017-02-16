<?php
	function chargerClasse($classe) {
		require $classe . '.class.php'; // On inclut la classe correspondante au paramètre passé.
	}

	spl_autoload_register('chargerClasse'); // On enregistre la fonction en autoload pour qu'elle soit appelée dès qu'on instanciera une classe non déclarée.

	// Programme : Login.php
	// Description : programme de login pour la section à accès réservé.
	$logger = new Logger('logs/');
	$logger->log('info', 'infos', "Entree dans ActionLogin.php", Logger::GRAN_MONTH);

	ob_start();
	if (isset($_SESSION['session_started'])) {
		session_destroy();
	}
	session_start();

	require_once("config/config.php");
	switch(@$_POST['do']) {
		case "login": {

			//echo phpinfo();
			// création de la connexion au serveur de base de données
			$logger->log('info', 'infos', "Ouverture de la connexion à la base de données.", Logger::GRAN_MONTH);
			try {

				$db = new PDO('mysql:host='.$db_host.';dbname='.$db_name, $db_login, $db_password);
				$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // On émet une alerte à chaque fois qu'une requête a échoué.
				$db->setAttribute(PDO::MYSQL_ATTR_USE_BUFFERED_QUERY, true);
			} catch (PDOException $error) { //Le catch est chargé d’intercepter une éventuelle erreur
				echo "N° : ".$error->getCode()."<br />";
				die ("Erreur : ".$error->getMessage()."<br />");
			}

			$login = $_POST[login];
			// hachage du mot de passe
			$password = hash('sha256', $_POST[password]);

			/*$managerTournoi = new TournoiManager($db);
			$listeTournois = $managerTournoi->trouverTournois(0);

			$managerEquipe = new EquipeManager($db);
			$listeEquipes = $managerEquipe->trouverEquipes();

			$managerGroupe = new GroupeManager($db);
			$listeGroupes = $managerGroupe->trouverGroupes();

			$managerCategorie = new CategorieManager($db);
			$listeCategories = $managerCategorie->trouverCategories();*/

			/*
			$manager = new UtilisateurManager($db);

			if ($manager->exists($login, $password)) { // login trouvé
				$logger->log('info', 'infos', "Authentification de ".$login.".", Logger::GRAN_MONTH);
				// mise à jour de la date de dernière connexion
				$manager->updateDerniereConnexion($login);
				// Mise en session
				$_SESSION['login'] = $login;
				$_SESSION['session_started'] = "session_started";
				header("Location: RechercherComptesUtilisateur.php");
			} else {
				$logger->log('erreur', 'erreurs', "Erreur lors de l'authentification de ".$login.".", Logger::GRAN_MONTH);
				//echo "Login ou mot de passe incorrect"."<br>";
				$_SESSION['messageKO'] = "Mauvais login ou mot de passe.";
				header("Location: index.php");
			}
			*/
			$_SESSION['session_started'] = "session_started";
			//header("Location: AfficherListeTournois.php");
			header("Location: accueil.php");
		}
	}


	ob_end_flush();
?>