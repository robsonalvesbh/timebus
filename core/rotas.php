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
	protected $rotas = array(
      "onibus" => "onibus/pegaOnibus",
      "onibus/:any" => "onibus/pegaHorario"
   );

	/**
	 * Função que verifica se existe a rota recebida pela requisição
	 * @param  String $rota [Rota recebida pela requisição]
	 * @return Bool       	[true se existe e falso se não existe]
	 */
	protected function validaRota( $uri )
	{
      foreach ($this->rotas as $chave => $valor)
      {
         // Convertendo :any por .+ e :num por [0-9]+
         $chave = str_replace(':any', '.+', str_replace(':num', '[0-9]+', $chave));

         // validação da rota com regex
         if (preg_match('#^'.$chave.'$#', $uri))
         {
           return $valor;
         }
      }

      return Resposta::enviar( array('status' => 400, 'mensagem' => Constantes::STATUS_400) );
	}

}
