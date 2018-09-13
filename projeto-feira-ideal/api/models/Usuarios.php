<?php 

class Usuarios extends model{

	public function getUsuario($login, $senha){
		$dados = array();

		$sql = "SELECT id FROM users WHERE login = :login AND senha = :senha";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':login', $login);
		$sql->bindValue(':senha', md5($senha));
		$sql->execute();

		if($sql->rowCount() > 0){

			$dados = $sql->fetch();

			return $dados;

		}else{
			return false;
		}

	}	

}