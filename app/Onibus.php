<?php

class Onibus
{
	private $db;

	public function __construct( )
	{
		$this->db = new OnibusDAO();
	}

	public function pegaHorario( $linha )
	{
		$resultado = $this->db->getHorarios( $linha );

		if (is_array($resultado) && empty($resultado))
			return Resposta::enviar( array('status' => 410, 'mensagem' => Constantes::STATUS_410) );
		else
			return Resposta::enviar( array(
				'status' => 200,
				'mensagem' => Constantes::STATUS_200,
				'dados' => $resultado
			) );
	}

   public function pegaTodosHorarios( )
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

}
