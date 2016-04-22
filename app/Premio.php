<?php

class Premio extends Requisicao
{

	public function __construct( $metodo )
	{
		if (method_exists($this, $metodo)) {
			$this->$metodo();
		}
	}

	public function index()
	{
		Resposta::enviar( array('message' => Constantes::STATUS_403 . 'onibus') );
	}

	public function get()
	{
		echo json_encode($_GET);exit;
	}

	public function post()
	{

		echo json_encode($_POST);exit;
	}
}
