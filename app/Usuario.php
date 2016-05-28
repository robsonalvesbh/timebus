<?php

class Usuario
{
	private $db;
	private $dados = array(
		"nome" => null,
		"email" => null,
		"senha" => null,
		"data_cadastro" => null
	);

	public function __construct( )
	{
		$this->db = new UsuarioDAO();
		$this->dados["data_cadastro"] = date('Y-m-d');
	}

	public function cadastrar()
	{
		$this->setDados($_POST);
		$resultado = $this->db->cadastrarUsuario($this->dados);

		if ($resultado)
			Resposta::enviar( array('status' => 200, 'mensagem' => Constantes::STATUS_200) );
		else
			Resposta::enviar( array('status' => 500, 'mensagem' => Constantes::STATUS_500) );
	}

	private function setDados($post) {
		try {
			foreach ($post as $chave => $valor) {
				if ($chave == "senha")
					$this->dados[$chave] = appUtil::criptografar($valor);
				else
					$this->dados[$chave] = $valor;
			}
		} catch (Exception $e) {
			Resposta::enviar( array('status' => 500, 'mensagem' => Constantes::STATUS_510) );
		}
	}

	public function logar() {
		$this->email = $_POST['email'];
		$this->senha = appUtil::criptografar($_POST['senha']);

		$resultado = $this->db->logarUsuario($this->email, $this->senha);

		if ($resultado)
			Resposta::enviar( array(
				'status' => 200,
				'mensagem' => Constantes::STATUS_200,
				'dados' => $resultado
			));
		else
			Resposta::enviar( array('status' => 500, 'mensagem' => Constantes::STATUS_500) );
	}

}
