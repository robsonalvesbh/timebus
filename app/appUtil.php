<?php

/**
 * Classe appUtil, com códigos que podem ser uteis para todas as classe
 * de dentro da pasta App
 */
class appUtil
{
    /**
     * Retorna a senha criptografada
     * @param  String $senha
     * @return String $senha criptografada
     */
    public static function criptografar($senha)
    {
        return sha1(md5($senha) . "*timeBusPassworld*");
    }
}
