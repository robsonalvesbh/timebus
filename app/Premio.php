<?php

class Premio {

	public function __construct( $metodo )
	{
		if (method_exists($this, $metodo)) {
			$this->$metodo();
		}
	}

	public function index()
	{
		echo "YEAP";
	}

	public function get()
	{
		echo "deu certo";
	}
}
