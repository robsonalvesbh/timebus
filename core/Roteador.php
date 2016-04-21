<?php
/**
 * Classe Roteadora, responsavel pelo roteamendo das requisições recebidas
 * Herda as rotas da classe Rotas
 */
class Roteador extends rotas
{

	private $caminho = array();

	public function __construct( $uri )
	{
		if (is_null($uri))
			$this->rotear('default');
		else
			$this->rotear($uri);
	}

	public function rotear( $uri )
	{
		if ( $this->validaRota($uri) )
		{
			$this->caminho = explode('/', $this->$uri);
			new $this->caminho[0]( isset($this->caminho[1]) ? $this->caminho[1] : 'index' );
		}
		else
		{
			return Requisicao::resposta( array('status' => 400, 'mensagem' => Constantes::STATUS_400) );
		}
	}

}
