<?php

class BaseDB {

	protected $db;

	public function __construct () {
		try {
			$this->db = new mysqli(Constantes::HOST, Constantes::USER, Constantes::PASSWORD, Constantes::DATABASE);
		} catch (Exception $e) {
			return Resposta::enviar( array('status' => 500, 'mensagem' => Constantes::STATUS_500) );
		}
	}

}
