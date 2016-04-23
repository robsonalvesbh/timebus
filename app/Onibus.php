<?php

class Onibus
{
	private $segmentos;
	private $db;

	public function __construct( $metodo, array $segmentos )
	{
		$this->db  = new OnibusDB();

		$this->segmentos = $this->validaSegmento($segmentos);

		if (method_exists($this, $metodo))
			$this->$metodo();
		else
			return Resposta::enviar( array('status' => 500, 'mensagem' => Constantes::STATUS_500) );
	}

	public function index( )
	{
		$result = $this->db->getHorarios( $this->segmentos[1] );

		if (is_array($result) && empty($result))
			return Resposta::enviar( array('status' => 410, 'mensagem' => Constantes::STATUS_410) );
		else
			Resposta::enviar( array(
				'status' => 200,
				'mensagem' => Constantes::STATUS_200,
				'dados' => $result
			) );
	}

	private function validaSegmento( $segmentos )
	{
		if (is_array($segmentos) && !empty($segmentos))
			return $segmentos;
		else
			return Resposta::enviar( array('status' => 400, 'mensagem' => Constantes::STATUS_400) );
	}
}
