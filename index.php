<?php
session_start();
/**
 * Estado da aplicação
 * Se estiver em desenvolvimento, exibe qualquer erro que apareça
 * Se estiver em producao, esconde os erros
 */
define("ESTADOAPLICACAO", "desenvolvimento");

switch (ESTADOAPLICACAO) {
    case "desenvolvimento":
        ini_set("display_errors", 1);
        ini_set("display_startup_errors", 1);
        error_reporting(E_ALL);
        break;

    case "producao":
        ini_set("display_errors", false);
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

try {

    require_once("core/Constantes.php");
    require_once(Constantes::PATH_CORE . "load.php");
} catch (Exception $e) {
    Resposta::enviar(array("status" => 500, "mensagem" => $e->getMessage()));
}

/**
 * Iniciando nossa Aplicação
 */
$r = new Roteador(isset($_GET["uri"]) ? $_GET["uri"] : NULL);
$r->rotear();


