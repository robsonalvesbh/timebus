<?php

class Onibus
{
	private $segmentos;
	private $req;
	private $db;

	public function __construct( $metodo, array $segmentos )
	{
		$this->req = new BaseApi();
		$this->db  = new OnibusDB();

		$this->segmentos = $segmentos;

		if (method_exists($this, $metodo))
			$this->$metodo();
		else
			Resposta::enviar( array('status' => 500, 'mensagem' => Constantes::STATUS_500) );
	}

	public function index( )
	{

	}
}
