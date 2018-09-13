<?php

class Lojas extends model{

	public function getLojas(){
		$dados = array();

		$sql = "SELECT cnpj, nome_fantasia, ativo FROM estabelecimentos ORDER BY nome_fantasia";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0){

			$dados = $sql->fetchAll();

			return $dados;

		}

	}	

}