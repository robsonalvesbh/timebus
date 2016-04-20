<?php

class Roteador {

	private $rotas = array();
	public $caminho = array();

	public function __construct( $uri ) {
		$this->getAndSetRotas();

		if (is_null($uri)) {
			$this->rotear('default');
		}
		else
		{
			$this->rotear($uri);
		}
	}

	private function getAndSetRotas() {

		if ( file_exists( PATH_CORE.'rotas.php' ) )
		{
			require_once( PATH_CORE.'rotas.php' );
		}

		if (isset($rota) && is_array($rota))
		{
			$this->rotas = $rota;
		}
	}

	public function mapaRotas() {
		echo "<hr> <pre>";
		print_r($this->rotas);
	}

	public function rotear( $uri ) {

		if ( array_key_exists($uri, $this->rotas) ) {
			$this->caminho = explode('/', $this->rotas[$uri]);
			new $this->caminho[0]( isset($this->caminho[1]) ? $this->caminho[1] : 'index' );
		}
		else
		{
			echo "URL Inválida!";
		}
	}

	function dd($value) {
		echo "<pre>";
		print_r($value);
		echo "</pre>";
	}
}
