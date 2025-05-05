<?php
class DB {

	protected static $instance;

	protected function __construct() {}
// Este metodo se usa para obtener la instancia única de la clase DB
	public static function getInstance() {
// Verificación de existencia
		if(empty(self::$instance)) {

			$db_info = array(
				"db_host" => "localhost",
				"db_port" => "3306",
				"db_user" => "root",
				"db_pass" => "",
				"db_name" => "rapidgobdd"
            );

			try {
                // conexion a la base de datos
				self::$instance = new PDO("mysql:host=".$db_info['db_host'].';port='.$db_info['db_port'].';dbname='.$db_info['db_name'], 
                $db_info['db_user'], 
                $db_info['db_pass']);
				
                // Configura como se manejan los errores de PDO
				self::$instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);  
				self::$instance->query('SET NAMES utf8');
				self::$instance->query('SET CHARACTER SET utf8');

			} catch(PDOException $e) {
				http_response_code(500);
				echo json_encode(['error' => 'Error en la búsqueda', 'message' => $e->getMessage()]);
			}

		}
		// Si ya existe una instancia, simplemente la devuelve. Si no, devuelve la nueva conexion creada.

		return self::$instance;
		
	}

}