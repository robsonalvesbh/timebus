<?php

/**
 * Classe Roteadora, responsavel pelo roteamendo das requisições recebidas
 * Herda as rotas da classe Rotas
 */
class Roteador extends Rotas
{
    private $uri;

    /**
     * Recebe a url passada na requisição e valida se ela tem algum parametro
     * para rotear, caso não tenha é roteado a rota default
     * @param [String] [$uri] Url passada na requisição após a url base
     */
    public function __construct($uri)
    {
        if (!is_null($uri))
            $this->uri = $uri;
        else
            Resposta::enviar(array('status' => 400, 'mensagem' => Constantes::STATUS_400));
    }

    /**
     * Faz o roteamento da requisição estanciando o objeto
     * da classe que deverá ser chamada
     * @param [String] [$uri] Url passada na requisição após a url base
     */
    public function rotear()
    {
        /**
         * Cada parametro da url é convertido em um valor para nosso array
         * Por exemplo, se na requisição vier 'onibus/3333'
         * O array segmento terá 2 valores 'onibus' e '3333'
         * @var [array] $segmento
         */
        return new Requisicao (
            $this->validaRota($this->uri),
            $this->uri
        );
    }
}
