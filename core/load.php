<?php

/**
 * Função de Autoload, sempre que algum arquivo tenta estanciar um objeto
 * O new dispara o autoload que tenta fazer o require da classe de forma automatica
 *
 * Nesta função tentamos fazer a inclusão de classes que estão dentro da pasta APP, CORE e OUTPUT
 */
spl_autoload_register(function ($class_name) {

	if ( file_exists( Constantes::PATH_APP.ucfirst($class_name).'.php' ) )
		require_once( Constantes::PATH_APP.ucfirst($class_name).'.php' );
	else if ( file_exists( Constantes::PATH_CORE.ucfirst($class_name).'.php' ) )
		require_once( Constantes::PATH_CORE.ucfirst($class_name).'.php' );
	else if ( file_exists( Constantes::PATH_OUTPUT.ucfirst($class_name).'.php' ) )
		require_once( Constantes::PATH_OUTPUT.ucfirst($class_name).'.php' );
	else {
		Requisicao::resposta( array('status' => 400, 'mensagem' => Constantes::STATUS_400) );
		exit;
	}
});
