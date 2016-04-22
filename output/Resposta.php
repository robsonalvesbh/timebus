<?php

/**
 * Classe de resposta da requisição
 */
class Resposta
{
	/**
	 * Metodo estático que ecoa na tela a resposta em formato Json
	 * @param  array  $dados [dados de retorno]
	 * @return [Json]        [Os dados de retorno em formato Json]
	 */
	public static function enviar( array $dados )
	{
		header('Content-Type: application/json; charset=utf-8');
		echo json_encode($dados, JSON_UNESCAPED_UNICODE);
		exit;
	}

}

