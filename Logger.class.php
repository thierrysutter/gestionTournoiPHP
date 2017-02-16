<?php
class Logger {
 
    private $depot; // Dossier où sont enregistrés les fichiers logs
    private $ready; // Le logger est prêt quand le dossier de dépôt des logs existe
     
    // Granularité
    const GRAN_VOID  = 'VOID';  // Aucun archivage
    const GRAN_MONTH = 'MONTH'; // Archivage mensuel
    const GRAN_YEAR  = 'YEAR';  // Archivage annuel
 
	public function __construct($path){
		$this->ready = false;
		 
		// Si le dépôt n'existe pas
		if( !is_dir($path) ){
			trigger_error("<code>$path</code> n'existe pas", E_USER_WARNING);
			return false;
		}
		 
		$this->depot = realpath($path);
		$this->ready = true;
		return true;
	}
	
	public function path($type, $name, $granularity = self::GRAN_YEAR){
		// On vérifie que le logger est prêt (et donc que le dossier de dépôt existe
		if( !$this->ready ){
			trigger_error("Logger is not ready", E_USER_WARNING);
			return false;
		}
		 
		// Contrôle des arguments
		if( !isset($type) || empty($name) ){
			trigger_error("Paramètres incorrects", E_USER_WARNING);
			return false;
		}
			 
		// Si $type est vide, on enregistre le log directement à la racine du dépôt
		if( empty($type) ){
			$type_path = $this->depot.'/';
		}
		// Création dossier du type
		else {
			$type_path = $this->depot.'/'.$type.'/';
			if( !is_dir($type_path) ){
				mkdir($type_path);
			}
		}
		 
		// Création du dossier granularity
		if( $granularity == self::GRAN_VOID ){
			$logfile = $type_path.$name.'.log';
		}
		elseif( $granularity == self::GRAN_MONTH ){
			$mois_courant   = date('Ym');
			$type_path_mois = $type_path.$mois_courant;
			if( !is_dir($type_path_mois) ){
				mkdir($type_path_mois);
			}
			$logfile = $type_path_mois.'/'.$mois_courant.'_'.$name.'.log';
		}
		elseif( $granularity == self::GRAN_YEAR ){
			$current_year   = date('Y');
			$type_path_year = $type_path.$current_year;
			if( !is_dir($type_path_year) ){
				mkdir($type_path_year);
			}
			$logfile = $type_path_year.'/'.$current_year.'_'.$name.'.log';
		}
		else{
			trigger_error("Granularité '$granularity' non prise en charge", E_USER_WARNING);
			return false;
		}
		 
		return $logfile;
	}
	
	public function log($type, $name, $row, $granularity = self::GRAN_YEAR){
		// Contrôle des arguments
		if( !isset($type) || empty($name) || empty($row) ){
			trigger_error("Paramètres incorrects", E_USER_WARNING);
			return false;
		}
		 
		$logfile = $this->path($type, $name, $granularity);
		 
		if( $logfile === false ){
			trigger_error("Impossible d'enregistrer le log", E_USER_WARNING);
			return false;
		}
		 
		// Ajout de la date et de l'heure au début de la ligne
		$row = date('d/m/Y H:i:s').' '.$row;
		 
		// Ajout du retour chariot de fin de ligne si il n'y en a pas
		if( !preg_match('#\n$#',$row) ){
			$row .= "\n";
		}
		 
		$this->write($logfile, $row);
	}
	private function write($logfile, $row){
		if( !$this->ready ){return false;}
		 
		if( empty($logfile) ){
			trigger_error("<code>$logfile</code> est vide", E_USER_WARNING);
			return false;
		}
		 
		$fichier = fopen($logfile,'a+');
		fputs($fichier, $row);
		fclose($fichier);
	}
}
?>