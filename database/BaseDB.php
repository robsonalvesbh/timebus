<?php

class BaseDB {

	protected $conn;

	public function connect () {
		try {

			$this->conn = new PDO ('
				mysql:host=' + Constantes::HOST+';
				dbname=' + Constantes::DATABASE+'',
				Constantes::USER,
				Constantes::PASSWORD
			);

		} catch (Exception $e) {
			Resposta::enviar( array('status' => 300, 'mensagem' => Constantes::STATUS_500) );
		}
	}

}
