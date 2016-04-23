<?php

class OnibusDB extends BaseDB
{
   public function getOnibus( )
   {
      $dados = array();

      $resultado = $this->db->query( '
         SELECT *
         FROM onibus
      ' );

      if ($resultado->num_rows != 0)
      {
         $dados = $this->filterDadosOnibus($resultado);
      }

      return $dados;
   }

   private function filterDadosOnibus( mysqli_result $result )
   {
      $dados = array();

      while ($r = $result->fetch_object()) {
         $dados[] = array_map("utf8_encode", array(
            "linha" => $r->linha,
            "origem" => $r->origem,
            "destino" => $r->destino,
            "municipio" => $r->municipio,
            "estado" => $r->estado,
            "empresa" => $r->empresa
         ));
      }

      return $dados;
   }

	public function getHorarios( $linha )
	{
		$dados = array();

		$resultOnibus = $this->db->query( '
			SELECT *
			FROM onibus o
			WHERE o.linha = "'.$linha.'"
		' );

		if ($resultOnibus->num_rows != 0)
		{
			$dados = $this->filterDadosLinha($resultOnibus);

			$resultHorario = $this->db->query( '
				SELECT *
				FROM horario h
				WHERE h.onibus_id = "'.$dados['onibus_id'].'"
			' );

			$dados["horarios"] = $this->filterHorarios($resultHorario);

			unset($dados['onibus_id']);
		}

		return $dados;
	}

	private function filterDadosLinha( mysqli_result $result )
	{
		$dados = array();

		while ($r = $result->fetch_object()) {
			$dados["linha"] = $r->linha;
			$dados["origem"] = $r->origem;
			$dados["destino"] = $r->destino;
			$dados["municipio"] = $r->municipio;
			$dados["estado"] = $r->estado;
			$dados["empresa"] = $r->empresa;
			$dados["onibus_id"] = $r->onibus_id;
		}

		return array_map("utf8_encode", $dados );
	}

	private function filterHorarios( mysqli_result $result )
	{
		$dados = array();

		while ($r = $result->fetch_object()) {
			if ($r->normal)
				$dados["normal"][] = array('hora' => $r->hora, 'minuto' => $r->minuto );
			else if ($r->sabado)
				$dados["sabado"][] = array('hora' => $r->hora, 'minuto' => $r->minuto );
			else if ($r->feriado_domingo)
				$dados["feriado_domingo"][] = array('hora' => $r->hora, 'minuto' => $r->minuto );
		}
		return $dados;
	}

}
