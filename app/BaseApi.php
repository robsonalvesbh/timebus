<?php

class BaseApi
{
	protected function get(  )
	{
		$dados = array();

		foreach ($_GET as $key => $value) {
			$dados[ $key ] = $value;
		}

		return $dados;
	}

	protected function post(  )
	{
		$dados = array();

		foreach ($_POST as $key => $value) {
			$dados[ $key ] = $value;
		}

		return $dados;
	}
}
