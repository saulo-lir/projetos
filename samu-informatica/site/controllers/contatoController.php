<?php

class contatoController extends controller{

	public function index(){}

	public function whatsapp(){
		$contato = new Contato();

		// Identificar qual dispositivo está acessando a api
		$iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
		$android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
		$palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
		$berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
		$ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");

		if($iphone || $android || $palmpre || $ipod || $berry){ // Dispositivo móvel

			$contato->contabilizarCliqueWhatsapp();
			
			echo 'https://api.whatsapp.com/send?phone=558296567029&text=Olá,%20gostaria%20de%20fazer%20um%20orçamento.';
		
		}else{ // Navegador desktop

			$contato->contabilizarCliqueWhatsapp();			

			echo 'https://web.whatsapp.com/send?phone=558296567029&text=Olá,%20gostaria%20de%20fazer%20um%20orçamento.';
		}

	}

	public function mensagem(){			

		if(isset($_POST['email'])){

			$email = addslashes($_POST['email']);
			$numero = addslashes($_POST['numero']);
			$mensagem = addslashes($_POST['mensagem']);	
			$t = strlen($mensagem);

			if(empty($email)){				
				$response['email'] = 'Este campo é obrigatório!';
				echo json_encode($response);

			}elseif($t < 10){
				$response['mensagem'] = 'A mensagem deve conter no mínimo 10 caracteres!';
				echo json_encode($response);
			
			}else{				

				$contato = new Contato();
				$contato->salvarMensagem($email, $numero, $mensagem);

				// Fazer o envio de email			

				$response['enviado'] = 'Mensagem enviada com sucesso!';
				echo json_encode($response);
			}

		}
	}	

}