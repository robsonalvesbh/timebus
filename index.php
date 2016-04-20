<?php 

/**
 * Estado da aplicação
 * Se estiver em desenvolvimento, exibe qualquer erro que apareça
 * Se estiver em producao, esconde os erros
 */
define(ESTADOAPLICACAO, 'desenvolvimento');

switch (ESTADOAPLICACAO)
{
	case 'desenvolvimento':
		error_reporting(-1);
		ini_set('display_errors', E_ALL);
	break;

	case 'producao':
		ini_set('display_errors', 0);
	break;
}

/**
 *  Define o header para aceitar requisições de outros servidores
 *  e aceitar apenas requisições do tipo GET e POST
 */
header("Access-Control-Allow-Origin: *");
header("Access-Control-Request-Methods: POST, GET");

/**
 * Requires/Inclusões de outros arquivos
 */
require('core/Roteador.php');

/**
 * Iniciando nossa Aplicação
 */
try {
	$rota = new Roteador( isset($_GET['uri']) ? $_GET['uri'] : NULL );
	$rota->mapaRotas();
} catch (Exception $e) {
	
}
