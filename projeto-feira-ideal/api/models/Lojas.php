<?php 

class Lojas extends model{

	public function getLoja($cnpj){
		$dados = array();

		$sql = "SELECT * FROM estabelecimentos WHERE cnpj = :cnpj";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':cnpj', $cnpj);
		$sql->execute();

		if($sql->rowCount() > 0){

			$dados = $sql->fetch();

			return $dados;

		}else{
			return false;
		}

	}	

}