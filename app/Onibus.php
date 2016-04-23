<?php

class Onibus
{
	private $segmentos;
	private $db;

	public function __construct( $metodo, array $segmentos )
	{
		$this->db = new OnibusDB();

		$this->validaSegmento($segmentos);

		if (method_exists($this, $metodo))
			$this->$metodo();
		else
			return Resposta::enviar( array('status' => 500, 'mensagem' => Constantes::STATUS_500) );
	}

	public function pegaHorario( )
	{
		$resultado = $this->db->getHorarios( $this->segmentos[1] );

		if (is_array($resultado) && empty($resultado))
			return Resposta::enviar( array('status' => 410, 'mensagem' => Constantes::STATUS_410) );
		else
			return Resposta::enviar( array(
				'status' => 200,
				'mensagem' => Constantes::STATUS_200,
				'dados' => $resultado
			) );
	}

   public function pegaOnibus( )
   {
      $resultado = $this->db->getOnibus( );

      if (is_array($resultado) && empty($resultado))
         return Resposta::enviar( array('status' => 410, 'mensagem' => Constantes::STATUS_410) );
      else
         return Resposta::enviar( array(
            'status' => 200,
            'mensagem' => Constantes::STATUS_200,
            'total' => sizeof($resultado),
            'dados' => $resultado
         ) );
   }

	private function validaSegmento( $segmentos )
	{
		if (is_array($segmentos) && !empty($segmentos))
			$this->segmentos = $segmentos;
		else
			return Resposta::enviar( array('status' => 400, 'mensagem' => Constantes::STATUS_400) );
	}
}
