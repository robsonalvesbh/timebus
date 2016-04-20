<?php 

require('../core/constantes.php');

class BaseDB {

	protected $conn;

	public function connect () {
		try {
			$this->conn = new PDO('mysql:host='+HOST+';dbname='+DATABASE+'', USER, PASSWORD);
		} catch (Exception $e) {
			echo 'ERROR: ' . $e->getMessage();
		}
	}

}