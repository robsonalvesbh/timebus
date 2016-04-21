<?php

class Premio
{

	public function __construct( $metodo )
	{
		if (method_exists($this, $metodo)) {
			$this->$metodo();
		}
	}

	public function index()
	{

		Requisicao::resposta( array('message' => Constantes::STATUS_403) );

	}

	public function get()
	{
		echo "deu certo";
	}

	public function post()
	{
		echo "POST123";
	}
}
