<?php

/**
 * Classe de constantes
 */
class Constantes
{
	/**
	 * CONSTANTES DE CAMINHO
	 */
	// define("URL_ROOT", "http://localhost/Projetos/appBus/");
	const PATH_APP 	= 	"app/";
	const PATH_CORE 	= 	"core/";
	const PATH_DB 		= 	"database/";
	const PATH_OUTPUT = 	"output/";

	/**
	 * CONSTANTES DE MENSAGENS DE STATUS DE REQUISIÇÃO
	 */
	const STATUS_200 = "Requisição finalizada com sucesso.";
	const STATUS_400 = "Requisição inválida.";
	const STATUS_403 = "Acesso negado.";
	const STATUS_410 = "Nenhum registro encontrado.";
	const STATUS_500 = "Ocorreu um erro inesperado.";
	const STATUS_501 = "Serviço em desenvolvimento.";

	/**
	 * CONSTANTES DE ACESSO AO BANCO DE DADOS
	 * INFORME AQUI OS DADOS DE ACESSO AO SEU BANCO DE DADOS
	 */
	const HOST 		= "";
	const USER 		= "";
	const PASSWORD = "";
	const DATABASE = "";
}
