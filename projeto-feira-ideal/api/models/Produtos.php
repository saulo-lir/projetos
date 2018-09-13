<?php

class Produtos extends model{

	public function getProduto($cnpj, $codBarrasProduto){	

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

}