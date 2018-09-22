<?php

class Lojas extends model{

	public function getLojas(){
		$dados = array();

		$sql = "SELECT cnpj, razao_social, nome_fantasia, ativo FROM estabelecimentos";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0){

			$dados = $sql->fetchAll();

			return $dados;

		}

	}	

}