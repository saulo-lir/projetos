<?php

class Contato extends model{

	public function contabilizarCliqueWhatsapp(){

		$sql = "SELECT id, total_cliques FROM log_whatsapp";
		$sql = $this->db->query($sql);

		if($sql->rowCount() > 0){
			$sql = $sql->fetch();

			//print_r($sql);

			$sql = "UPDATE log_whatsapp SET total_cliques = ".$sql['total_cliques']." + 1, ultimo_clique = NOW() WHERE id = ".$sql['id']."";
			$sql = $this->db->query($sql);

		}else{

			$sql = "INSERT INTO log_whatsapp SET total_cliques = 1, ultimo_clique = NOW()";
			$sql = $this->db->query($sql);

		}

	}

	public function salvarMensagem($email, $cell_whats = null, $mensagem){
		
		$sql = "INSERT INTO contato SET email = :email, cell_whatsapp = :cell_whats, mensagem = :mensagem, created = NOW()";
		$sql = $this->db->prepare($sql);
		$sql->bindValue(':email', $email);
		$sql->bindValue(':cell_whats', $cell_whats);
		$sql->bindValue(':mensagem', $mensagem);
		$sql->execute();		

	}

}