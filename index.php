<?php
/**
 * Estado da aplicação
 * Se estiver em desenvolvimento, exibe qualquer erro que apareça
 * Se estiver em producao, esconde os erros
 */
define("ESTADOAPLICACAO", "desenvolvimento");

switch (ESTADOAPLICACAO)
{
	case 'desenvolvimento':
		ini_set('display_errors', true);
		ini_set('display_startup_errors', true);
		error_reporting(E_ALL);
	break;

	case 'producao':
		ini_set('display_errors', false);
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
require_once( 'core/constantes.php' );
require_once( Constantes::PATH_CORE.'load.php' );

/**
 * Iniciando nossa Aplicação
 */
new Roteador( isset($_GET['uri']) ? $_GET['uri'] : NULL );

