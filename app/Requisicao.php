<?php

/**
 * Classe base de todas as requisições
 */
class Requisicao
{
	private $classe;
	private $metodo;
	private $id;

	function __construct( $rota, $uri )
	{
		self::ExtraiSegmentos($uri);
		self::extraiRota($rota);
		self::chamaObjeto();
	}

	/**
	 * extrai os segmentos da url da requisição
	 * @param url da requisição
	 */
	private function ExtraiSegmentos( $uri )
	{
		try {
			$id = explode("/", $uri);
			$this->id = (empty($id[1]) ? null : $id[1]);
		} catch (Exception $e) {
			Resposta::enviar( array('status' => 500, 'mensagem' => $e->getMessage()) );
		}
	}

	/**
	 * Pega a classe e o metodo que será utilizado na requisição
	 * @param recebe a rota
	 */
	private function extraiRota( $rota )
	{
		try {
			$aux = explode("/", $rota );
			$this->classe  = ucfirst($aux[0]);
			$this->metodo  = isset($aux[1]) ? $aux[1] : "index";
		} catch (Exception $e) {
			Resposta::enviar( array('status' => 500, 'mensagem' => $e->getMessage()) );
		}
	}

	/**
	 * cria a estancia da classe
	 * e chama o metodo que será utilizado
	 */
	private function chamaObjeto()
	{
		try {
			if (method_exists($this->classe, $this->metodo))
			{
				$ob = new $this->classe;
				if (!is_null($this->id))
					$ob->{$this->metodo}( $this->id );
				else
					$ob->{$this->metodo}();
			}
		} catch (Exception $e) {
			Resposta::enviar( array('status' => 500, 'mensagem' => $e->getMessage()) );
		}
	}
}
