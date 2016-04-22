<?php

/**
 * Classe Rotas, possui como atributo todas as rotas disponivels para requisição
 */
class Rotas
{
	/**
	 * O nome do atributo será a requisição esperada
	 * E seu valor é um arrayn onde o primeiro elemento é a classe
	 * e o segundo elemento é o metodo que será chamado
	 * @var string
	 */
	protected $onibus		= [ "onibus" ];
	protected $default 	= [ "premio"];

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
