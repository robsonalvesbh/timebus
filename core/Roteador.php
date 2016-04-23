<?php
/**
 * Classe Roteadora, responsavel pelo roteamendo das requisições recebidas
 * Herda as rotas da classe Rotas
 */
class Roteador extends Rotas
{
	private $segmento = array();
	private $classe;
	private $metodo;

	/**
	 * Recebe a url passada na requisição e valida se ela tem algum parametro
	 * para rotear, caso não tenha é roteado a rota default
	 * @param [String] [$uri] Url passada na requisição após a url base
	 */
	public function __construct( $uri )
	{
		if (!is_null($uri))
			$this->rotear($uri);
		else
			return Resposta::enviar( array('status' => 400, 'mensagem' => Constantes::STATUS_400) );
	}

	/**
	 * Faz o roteamento da requisição estanciando o objeto
	 * da classe que deverá ser chamada
	 * @param [String] [$uri] Url passada na requisição após a url base
	 */
	public function rotear( $uri )
	{
		/**
		 * Cada parametro da url é convertido em um valor para nosso array
		 * Por exemplo, se na requisição vier 'onibus/3333'
		 * O array segmento terá 2 valores 'onibus' e '3333'
		 * @var [array] $segmento
		 */
		$this->segmento = explode('/', $uri);

		$rota = explode("/", $this->validaRota($uri));

		$this->classe  = ucfirst($rota[0]);
		$this->metodo  = isset($rota[1]) ? $rota[1] : "index";

		return new $this->classe ( $this->metodo, $this->segmento );
	}

}
