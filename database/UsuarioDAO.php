<?php

class UsuarioDAO extends BaseDAO
{
   public function cadastrarUsuario( array $user )
   {
      $query = $this->db->prepare( "
         INSERT INTO usuario(nome, email, senha, data_cadastro)
         VALUES ( ?, ?, ?, ? );
      " );

      $query->bind_param(
      	'ssss',
			$user['nome'],
			$user['email'],
			$user['senha'],
			$user['data_cadastro']
      );

      if ( $query->execute() )
      	return true;
      else
      	return false;
   }

   public function logarUsuario( $email, $senha )
   {
      $query = $this->db->prepare( "
         SELECT usuario_id, nome, email, data_cadastro
         FROM usuario u
         WHERE u.email = ?
         AND u.senha = ?
         LIMIT 1
      " );

      $query->bind_param(
      	'ss',
			$email,
			$senha
      );
      $query->execute();

      $query->bind_result($id, $nome, $email, $data_cadastro);

      $dados = array();
      while($query->fetch())
   	{
   		$dados["id"] = $id;
   		$dados["nome"] = $nome;
   		$dados["email"] = $email;
   		$dados["data"] = $data_cadastro;
   	}

      if ( count($dados) > 0 )
		{
			$result = $this->geraHashLogin($dados);
	   	if ($result !== "false")
			{
				$dados['hash_cliente'] = $result;
			}
	   	return $dados;
		}
      else
      	return false;
   }

   private function geraHashLogin($dados) {

   	$hash = sha1( md5(
   		"timeBus" .
   		$dados["email"] .
   		$dados["nome"] .
   		date("Y-d-m H:i") .
   		$dados["id"]
   	) );

   	$query = $this->db->prepare( "
         UPDATE usuario
         SET hash_login = ?
         WHERE usuario_id = ?
      " );

      $query->bind_param(
      	'si',
			$hash,
			$dados['id']
      );

      // var_dump($this->db->preparedQuery($this->db->prepare, $query->bind_param));exit;

      if ( $query->execute() )
   	{
   		$_SESSION["hashLogin"] = $hash;
   		return $hash;
   	}
      else
      	return false;
   }
}
