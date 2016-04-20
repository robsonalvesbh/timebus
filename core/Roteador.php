<?php 

class Roteador {

	private $rotas = array();
	public $segmento = array();

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

		if ( file_exists('core/rotas.php') )
		{
			require_once('core/rotas.php');
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
			echo $this->rotas[$uri];
			$this->segmento = explode('/', $uri);

			$this->dd($this->segmento) ;
		}
		else
		{
			echo $uri;
			echo "<hr> Rota não encontrada ";
		}
	}

	function dd($value) {
		echo "<pre>";
		print_r($value);
		echo "</pre>";
	}
}