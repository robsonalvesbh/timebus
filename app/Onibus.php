<?php

/**
 * Classe que trata as requisições de onibus
 */
class Onibus
{
    private $db; // propriedade que fara o intermedio entre o controller e o model

    public function __construct()
    {
        $this->db = new OnibusDAO(); // estanciando o model
    }

    /**
     * Pega os horarios de uma linha
     * @param  String $linha linha de onibus
     * @return Json com os dados dos horarios
     */
    public function pegaHorario($linha)
    {
        $resultado = $this->db->getHorarios($linha);

        if (is_array($resultado) && empty($resultado))
            return Resposta::enviar(array('status' => 410, 'mensagem' => Constantes::STATUS_410));
        else
            return Resposta::enviar(array(
                'status' => 200,
                'mensagem' => Constantes::STATUS_200,
                'dados' => $resultado
            ));
    }

    /**
     * Pega todos os onibus cadastrados no banco de dados
     * @return Json com os dados dos onibus
     */
    public function pegaTodosHorarios()
    {
        $resultado = $this->db->getOnibus();

        if (is_array($resultado) && empty($resultado))
            return Resposta::enviar(array('status' => 410, 'mensagem' => Constantes::STATUS_410));
        else
            return Resposta::enviar(array(
                'status' => 200,
                'mensagem' => Constantes::STATUS_200,
                'total' => sizeof($resultado),
                'dados' => $resultado
            ));
    }

}
