<?php

/**
 * Classe Rotas, possui como atributo todas as rotas disponivels para requisição
 */
class Rotas
{
	/**
	 * O nome do atributo será a requisição esperada
	 * E seu valor é a classe / metodo / id respectivamente
	 * @var string
	 */
	protected $post = "premio/post";
	protected $premio = "premio";
	protected $onibus = "contato";
	protected $default = "premio";

	/**
	 * Função que verifica se existe a rota recebida pela requisição
	 * @param  String $rota [Rota recebida pela requisição]
	 * @return Bool       	[true se existe e falso se não existe]
	 */
	protected function validaRota( $rota )
	{
		if ( property_exists(new Rotas, $rota) )
			return true;
		else
			return false;
	}

}
