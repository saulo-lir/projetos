<?php

class Produtos extends model{

	public function getProduto($cnpj, $codBarrasProduto){
		$produto = [];

		$sql = $this->db->prepare("SELECT dscProduto, valUltimaVenda, dthEmissaoUltimaVenda FROM produtos WHERE cnpj_estabelecimento = :cnpj AND cod_barras = :codBarrasProduto");
		$sql->bindValue(":cnpj", $cnpj);
		$sql->bindValue(":codBarrasProduto", $codBarrasProduto);
		$sql->execute();

		if($sql->rowCount() > 0){
			$produto = $sql->fetch();	

			$produto['valUltimaVenda'] = (float)$produto['valUltimaVenda'];		
			$produto['dthEmissaoUltimaVenda'] = date('d/m/Y \à\s H:i:s', strtotime($produto['dthEmissaoUltimaVenda']));
		
		}else{
			$produto = false;
		}

		return $produto;
	}


	// Selecionar produto na api da sefaz
	public function getProdutoAPI($cnpj, $codBarrasProduto){	

		$resultado = [];
		$ch = curl_init();

		curl_setopt_array($ch, [

		    CURLOPT_URL => 'http://api.sefaz.al.gov.br/sfz_nfce_api/api/public/consultarPrecoProdutoEmEstabelecimento',

		    CURLOPT_POST => true,

		    CURLOPT_HTTPHEADER => [
		        'Content-Type: application/json',        
		        'AppToken: API_KEY'               
		    ],

		    CURLOPT_POSTFIELDS => json_encode([
		        'cnpj' => $cnpj, 
		        'codigoBarras'=> $codBarrasProduto, 
		        'quantidadeDeDias' => 3
		    ]),
		    
		    CURLOPT_RETURNTRANSFER => true
	    	//CURLOPT_PROTOCOLS => CURLPROTO_HTTPS

		]);

		$resultado = curl_exec($ch);
		$resultado = json_decode($resultado);

		curl_close($ch);

		if($resultado){			

			/* Formatando a data para padrão Brasileiro */
			$resultado->dthEmissaoUltimaVenda = date('d/m/Y \à\s H:i:s', strtotime($resultado->dthEmissaoUltimaVenda));			

			return $resultado;
		
		}else{		

			return false;
		}						

	}

	public function registrarPesquisa($registro=array()){

		$count = count($registro['cod_barras']);		

		for($i=0;$i<$count;$i++){

			$sql = $this->db->prepare("INSERT INTO log_consultas SET user_id = :user_id, nome_feira = :nome_feira, cnpj_estabelecimento = :cnpj, cod_barras = :cod_barras, quantidade = :quantidade, dscProduto = :dscProduto, valUltimaVenda = :valUltimaVenda, dthEmissaoUltimaVenda = :dthEmissaoUltimaVenda, data_consulta = NOW()");
		
			$sql->bindValue(':user_id', $registro['id_user']);
			$sql->bindValue(':nome_feira', $registro['nome_feira']);
			$sql->bindValue(':cnpj', $registro['cnpj']);
			$sql->bindValue(':cod_barras', $registro['cod_barras'][$i]);
			$sql->bindValue(':quantidade', $registro['quantidade'][$i]);
			$sql->bindValue(':dscProduto', $registro['descricao'][$i]);
			$sql->bindValue(':valUltimaVenda', $registro['preco'][$i]);
			$sql->bindValue(':dthEmissaoUltimaVenda', $registro['ult_registro'][$i]);
			$sql->execute();

		}		

	}

}